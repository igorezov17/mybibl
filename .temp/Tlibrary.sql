USE [Diplom]
GO


CREATE TABLE [dbo].[t.Library](
	[LibraryId] [int] IDENTITY(1,1),
	[NameLibrary] [nvarchar](50) NOT NULL,
	)
GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[t.library]
ADD  CONSTRAINT DF_Diplom_Name_Library_Unique  UNIQUE (NameLibrary)
GO


ALTER TABLE [dbo].[t.library]
ADD  CONSTRAINT PK_t_library_LibraryId PRIMARY KEY CLUSTERED (LibraryId)
GO

