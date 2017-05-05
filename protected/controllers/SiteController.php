<?php

class SiteController extends Controller
{    
	protected $loginModel = null;
	protected $ide = null;
    protected $errors = array();
    
    protected function beforeAction() {
        if (Yii::app()->user->isGuest) {
			$this->loginModel = new LoginForm;

            if (isset($_POST['LoginForm']))
            {
                $this->loginModel->attributes = $_POST['LoginForm'];
                
                if ($this->loginModel->validate()) {
                    $this->ide = $this->loginModel->getIde();

                    Yii::app()->user->login($this->ide, 3600*24);
                } else {
                    $this->pullError($this->loginModel->getErrors());
                }
            }
        }

        return true;
    }

    private function pullError($errors) {
        foreach ($errors as $error) {
            foreach($error as $er) {
                array_push($this->errors, $er);
            }
        }
    }

    public function actionError()
    {
        if ($error=Yii::app()->errorHandler->error)
        {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            }
            else {
                $this->render('error', $error);
            }
        }
    }
    
    public function actionRegister()
    {
        $model = new RegisterForm;
        
        if (isset($_POST['RegisterForm']))
        {
            $model->attributes = $_POST['RegisterForm'];
            
            if ($model->validate()) {
                $user = new Users;
                $user->email = $model->email;
                $user->public_key = md5($model->email+'+'+$model->password);
                $user->save();
                
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        
        $this->render('register', array('model' => $model));
    }

    public function actionBook()
    {
        $id = intval(Yii::app()->request->getQuery('id', -1));
        $param = Yii::app()->request->getQuery('param');

        if ($param === 'add') {
            $this->addShoppingCart(strval($id));

            $this->redirect(Yii::app()->createUrl('/book/'.$id));
        }

        if ($id != -1) {
            $book = Books::model()->findByPk($id);
            $stores = Store::model()->with('library')->findAll('book_id = '.$book->id);

            $count = 0;
            foreach($stores as $store) {
                $count += $store->count;
            }

            $this->render('book', array('stores' => $stores, 'id' => $id, 'book' => $book, 'count' => $count));
        }
    }
    
    public function actionIndex()
    {
        $ret = array();

        $books = Books::model()->findAll();
        $ret['books'] = $books;
        
        $this->render('index', $ret);
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        
        $this->redirect('/');
    }

    public function actionAddStore()
    {
        $id = intval(Yii::app()->request->getQuery('id', -1));

        if (!Yii::app()->user->isGuest && Yii::app()->user->permission && $id != -1) {
			$addform = new AddStoreForm;

			if (isset($_POST['AddStoreForm'])) {
				$addform->attributes = $_POST['AddStoreForm'];
                
                if ($addform->validate()) {
                    if (!$store = Store::model()->find('book_id = :bid AND library_id = :libid', array(':bid' => $id, ':libid' => $addform->library))) {
                        $store = new Store;
                        $store->library_id = intval($addform->library);
                        $store->book_id = $id;
                    }

					$store->count = $addform->count;

                    if (!$store->save()) {
                        $this->pullError($store->getErrors());
                    } else {
                        $this->redirect(Yii::app()->createUrl('/book/'.$id));
                    }
				}
			}

			$this->render('addstore', array('addform' => $addform));
		} else {
            
			$this->redirect(Yii::app()->createUrl('/'));
		}
    }

	public function actionAddBook()
    {
        if (!Yii::app()->user->isGuest && Yii::app()->user->permission) {
			$addform = new AddBookForm;

			if (isset($_POST['AddBookForm'])) {
				$addform->attributes = $_POST['AddBookForm'];
                
                if ($addform->validate()) {
					$book = new Books;
                    $book->label = $addform->label;
                    $book->author = $addform->author;

                    if (!$book->save()) {
                        array_push($this->errors, 'Ошибка');
                    } else {
                        $this->redirect(Yii::app()->createUrl('/addstore/'.$book->id));
                    }
				}
			}

			$this->render('addbook', array('addform' => $addform));
		} else {
			$this->redirect(Yii::app()->createUrl('/'));
		}
    }

    public function actionShoppingCart()
    {
        $ret = array();

        $id = intval(Yii::app()->request->getQuery('id', -1));
        $param = Yii::app()->request->getQuery('param');

        if ($param === 'del') {
            $this->removeShoppingCart(strval($id));

            $this->redirect(Yii::app()->createUrl('/shoppingcart'));
        }

        if ($param === 'get') {
            $this->render('shoppingcart', $ret);

            // Yii::app()->end();
        }
        
        if ($this->getCountShoppingCart() > 0) {
            $cart = $this->getShoppingCart();

            $condition = '';
            $first = true;
            $it = 0;
            $params = array();

            foreach ($cart as $prod) {
                $begin = $first ? '' : ' OR ';
                $first = false;
                $param_name = 'id'.$it;
                $it++;
                $params[$param_name] = $prod;
                $condition .= $begin.'id = :'.$param_name;
            }

            $store = Store::model()->findAll($condition, $params);
            $ret['books'] = $store;
        }
        
        $this->render('shoppingcart', $ret);
    }

    protected function getCountShoppingCart() {
        $cart = $this->getCookies('ShoppingCart');

        if ($cart !== null) {
            $exCart = explode(',', $cart);

            return count($exCart);
        }

        return 0;
    }

    protected function getShoppingCart() {
        $cart = $this->getCookies('ShoppingCart');

        if ($cart !== null) {
            $exCart = explode(',', $cart);

            return $exCart;
        }

        return array();
    }

    protected function removeShoppingCart($make) {
        $cart = $this->getCookies('ShoppingCart');

        if ($cart !== null) {
            $exCart = explode(',', $cart);

            $key = array_search($make, $exCart);
            if ($key !== false){
                unset($exCart[$key]);
            }

            $this->addCookies('ShoppingCart', join(',', $exCart));
        }
    }

    protected function addShoppingCart($make) {
        $cart = $this->getCookies('ShoppingCart');

        if ($cart !== null) {
            $exCart = explode(',', $cart);

            if (!in_array($make, $exCart)) {
                $cart .= ','.$make;
                $this->addCookies('ShoppingCart', $cart);
            }    
        } else {
            $this->addCookies('ShoppingCart', $make);
        }
    }

	protected function getCookies($name) {
		return isset(Yii::app()->request->cookies[$name]) ? Yii::app()->request->cookies[$name]->value : null;
	}

	protected function addCookies($name, $value, $time = 86400) {
		$cookie = new CHttpCookie($name, $value);
		$cookie->expire = time()+$time; 

		Yii::app()->request->cookies[$name] = $cookie;

		return $value;
	}
}