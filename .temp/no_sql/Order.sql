CREATE TABLE [dbo].[order](
	[orderid] [int] IDENTITY (1,1),
	[Users][nvarchar](50) NOT NULL,
	[Book] [int] NOT NULL,
	)
GO

ALTER TABLE [dbo].[order]
ADD  CONSTRAINT PK_t_order_book PRIMARY KEY CLUSTERED (orderid)
GO
