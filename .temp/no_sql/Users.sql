CREATE TABLE [dbo].[t.users](
	[Usersid] [int] IDENTITY (1,1),
	[Library][int] NOT NULL,
	[CreatedDate] datetime NOT NULL,
	[person] [nvarchar] (50) NOT NULL,
	)
GO

ALTER TABLE [dbo].[t.users]
ADD  CONSTRAINT DF_Blog_CreatedDate_Defaut  DEFAULT (getdate()) FOR CreatedDate
GO

ALTER TABLE [dbo].[t.users]
ADD  CONSTRAINT DF_Diplom_t_users_Unique  UNIQUE (person)
GO

ALTER TABLE [dbo].[t.users]
ADD  CONSTRAINT PK_t_users_Usersid PRIMARY KEY CLUSTERED (Usersid)
GO

ALTER TABLE [dbo].[t.users]
WITH CHECK ADD CONSTRAINT FK_Users_Usersid FOREIGN KEY(Usersid)
REFERENCES [dbo].[order] (orderid)
ON UPDATE CASCADE
ON DELETE CASCADE
GO