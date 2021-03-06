if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[tb_libros]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[tb_libros]
GO

CREATE TABLE [dbo].[tb_libros] (
	[codigo] [varchar] (200) COLLATE Modern_Spanish_CI_AS NOT NULL ,
	[tip_documento] [varchar] (200) COLLATE Modern_Spanish_CI_AS NULL ,
	[tema] [varchar] (200) COLLATE Modern_Spanish_CI_AS NULL ,
	[titulo] [varchar] (200) COLLATE Modern_Spanish_CI_AS NULL ,
	[autor] [varchar] (200) COLLATE Modern_Spanish_CI_AS NULL ,
	[lugar] [varchar] (200) COLLATE Modern_Spanish_CI_AS NULL ,
	[fecha_impresion] [datetime] NULL ,
	[resumen] [text] COLLATE Modern_Spanish_CI_AS NULL ,
	[palabras_clave] [varchar] (200) COLLATE Modern_Spanish_CI_AS NULL ,
	[anaquel] [varchar] (20) COLLATE Modern_Spanish_CI_AS NULL ,
	[entrepano] [varchar] (20) COLLATE Modern_Spanish_CI_AS NULL ,
	[fecha_ingreso] [datetime] NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

