USE [Diplom]
GO


CREATE TABLE [dbo].[t.books](
	[Bookid] [int] IDENTITY (1,1),
	[ÓÄÊ][int] NOT NULL,
	[ISBN] [int] NOT NULL,
	[NameBook][nvarchar](50) NOT NULL,
	)
GO

SET ANSI_PADDING OFF
GO 

ALTER TABLE [dbo].[t.books]
ADD  CONSTRAINT DF_Diplom_Name_Books_Unique  UNIQUE (NameBook)
GO

ALTER TABLE [dbo].[t.books]
ADD  CONSTRAINT PK_t_books_bookid PRIMARY KEY CLUSTERED (Bookid)
GO
