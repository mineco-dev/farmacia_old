USE [alm]
GO
/****** Object:  User [almacen]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [almacen] WITHOUT LOGIN WITH DEFAULT_SCHEMA=[almacen]
GO
/****** Object:  User [almacenusr]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [almacenusr] WITHOUT LOGIN WITH DEFAULT_SCHEMA=[almacenusr]
GO
/****** Object:  User [cgarciaq]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [cgarciaq] WITH DEFAULT_SCHEMA=[cgarciaq]
GO
/****** Object:  User [claguilar]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [claguilar] WITH DEFAULT_SCHEMA=[claguilar]
GO
/****** Object:  User [destada]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [destada] WITHOUT LOGIN WITH DEFAULT_SCHEMA=[destada]
GO
/****** Object:  User [jalvarez]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [jalvarez] WITH DEFAULT_SCHEMA=[jalvarez]
GO
/****** Object:  User [jzapata]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [jzapata] WITH DEFAULT_SCHEMA=[jzapata]
GO
/****** Object:  User [MASTER\Wzurdo]    Script Date: 10/10/2017 15:02:15 ******/
CREATE USER [MASTER\Wzurdo] WITH DEFAULT_SCHEMA=[MASTER\Wzurdo]
GO
/****** Object:  Schema [almacen]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [almacen] AUTHORIZATION [almacen]
GO
/****** Object:  Schema [almacenusr]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [almacenusr] AUTHORIZATION [almacenusr]
GO
/****** Object:  Schema [cgarciaq]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [cgarciaq] AUTHORIZATION [cgarciaq]
GO
/****** Object:  Schema [claguilar]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [claguilar] AUTHORIZATION [claguilar]
GO
/****** Object:  Schema [destada]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [destada] AUTHORIZATION [destada]
GO
/****** Object:  Schema [jalvarez]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [jalvarez] AUTHORIZATION [jalvarez]
GO
/****** Object:  Schema [jzapata]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [jzapata] AUTHORIZATION [jzapata]
GO
/****** Object:  Schema [MASTER\Wzurdo]    Script Date: 10/10/2017 15:02:11 ******/
CREATE SCHEMA [MASTER\Wzurdo] AUTHORIZATION [MASTER\Wzurdo]
GO
/****** Object:  Table [dbo].[cat_medida]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_medida](
	[codigo_medida] [int] NOT NULL,
	[unidad_medida] [varchar](50) NULL,
	[activo] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](50) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[codigo_bodega] [int] NULL,
 CONSTRAINT [PK_cat_medida] PRIMARY KEY CLUSTERED 
(
	[codigo_medida] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_estatus]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_estatus](
	[codigo_estatus] [int] NOT NULL,
	[estatus] [varchar](50) NULL,
 CONSTRAINT [PK_cat_estatus] PRIMARY KEY CLUSTERED 
(
	[codigo_estatus] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_estadoproducto]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_estadoproducto](
	[codigo_estado] [int] IDENTITY(1,1) NOT NULL,
	[estado_producto] [varchar](50) NULL,
	[activo] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](50) NULL,
	[fecha_desactivado] [datetime] NULL,
 CONSTRAINT [PK_cat_estadoproducto] PRIMARY KEY CLUSTERED 
(
	[codigo_estado] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_empresa]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_empresa](
	[codigo_empresa] [int] IDENTITY(1,1) NOT NULL,
	[empresa] [varchar](50) NULL,
	[direccion] [varchar](50) NULL,
	[telefono] [varchar](50) NULL,
	[usuario_creo] [varchar](50) NULL,
	[fecha_modifico] [varchar](50) NULL,
	[usuario_desactivo] [varchar](50) NULL,
	[fecha_desactivo] [varchar](50) NULL,
	[activo] [int] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_cuenta_fiscal]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_cuenta_fiscal](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_fiscal] [varchar](15) NULL,
	[descripcion] [varchar](150) NULL,
 CONSTRAINT [PK_cat_cuenta_fiscal] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_categoria]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_categoria](
	[codigo_categoria] [int] NOT NULL,
	[categoria] [varchar](100) NULL,
	[activo] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
 CONSTRAINT [PK_cat_categoria] PRIMARY KEY CLUSTERED 
(
	[codigo_categoria] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_bodega]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_bodega](
	[codigo_bodega] [int] IDENTITY(1,1) NOT NULL,
	[bodega] [varchar](25) NULL,
	[direccion] [varchar](100) NULL,
	[dependencia] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_empresa] [int] NULL,
 CONSTRAINT [PK_cat_bodega] PRIMARY KEY CLUSTERED 
(
	[codigo_bodega] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_actividad]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_actividad](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_programa] [int] NULL,
	[codigo_actividad] [int] NULL,
	[actividad] [varchar](250) NULL,
	[activo] [int] NULL,
	[anio] [varchar](10) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[bk_tb_ingreso_enc]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[bk_tb_ingreso_enc](
	[codigo_ingreso_enc] [int] IDENTITY(5,1) NOT NULL,
	[no_ingreso] [int] NULL,
	[codigo_tipo_documento] [int] NULL,
	[fecha_documento] [datetime] NULL,
	[numero_documento] [varchar](20) NULL,
	[numero_requisicion] [varchar](50) NULL,
	[fecha_requisicion] [datetime] NULL,
	[usuario_solicitante] [int] NULL,
	[solicitante] [varchar](50) NULL,
	[dependencia] [int] NULL,
	[observaciones] [varchar](200) NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_proveedor] [int] NULL,
	[fecha_recepcion] [datetime] NULL,
	[codigo_actividad] [int] NULL,
	[fecha_ingreso] [datetime] NULL,
	[codigo_programa] [int] NULL,
	[codigo_dependencia] [int] NULL,
	[folio_libro] [int] NULL,
	[nomenclatura_cuentas] [int] NULL,
	[numero_serie] [varchar](50) NULL,
	[userfile] [varchar](500) NULL,
	[codigo_empresa] [int] NULL,
	[codigo_bodega] [int] NULL,
	[codigo_estatus] [int] NULL,
	[justificacion] [text] NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[bk_tb_ingreso_det]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[bk_tb_ingreso_det](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_ingreso_enc] [int] NOT NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
	[codigo_producto] [int] NOT NULL,
	[cantidad_ingresada] [float] NULL,
	[costo_unidad] [decimal](18, 2) NULL,
	[Precio_total] [decimal](18, 2) NULL,
	[fecha_vence] [datetime] NULL,
	[cantidad_solicitada] [int] NULL,
	[codigo_bodega] [int] NOT NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](50) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_renglon] [int] NULL,
	[codigo_empresa] [int] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_renglon]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_renglon](
	[codigo_renglon] [int] NOT NULL,
	[descripcion] [varchar](150) NULL,
 CONSTRAINT [PK_cat_renglon] PRIMARY KEY CLUSTERED 
(
	[codigo_renglon] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_programa]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_programa](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_programa] [int] NULL,
	[programa] [varchar](250) NULL,
	[activo] [int] NULL,
	[anio] [nvarchar](10) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [MASTER\Wzurdo].[cat_producto_bk]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [MASTER\Wzurdo].[cat_producto_bk](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_categoria] [int] NOT NULL,
	[codigo_subcategoria] [int] NOT NULL,
	[codigo_producto] [int] NOT NULL,
	[producto] [varchar](256) NULL,
	[marca] [varchar](100) NULL,
	[codigo_medida] [int] NULL,
	[codigo_estado] [int] NULL,
	[punto_reorden] [int] NULL,
	[existencia_maxima] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[uso] [varchar](500) NULL,
	[codigo_renglon] [int] NULL,
	[codigo_fiscal] [int] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_proveedor]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_proveedor](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[nit] [varchar](20) NULL,
	[nombre] [varchar](100) NULL,
	[direccion] [varchar](100) NULL,
	[telefonos] [varchar](100) NULL,
	[contacto] [varchar](50) NULL,
	[corrreo] [varchar](50) NULL,
	[naturaleza] [varchar](150) NULL,
	[lista_negra] [int] NULL,
	[motivo_lista_negra] [varchar](200) NULL,
 CONSTRAINT [PK_tb_proveedor] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_programa]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_programa](
	[codigo_programa] [int] NOT NULL,
	[Descripcion] [varchar](100) NULL,
	[activo] [int] NULL,
 CONSTRAINT [PK_tb_programa] PRIMARY KEY CLUSTERED 
(
	[codigo_programa] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_requisicion_enc]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_requisicion_enc](
	[codigo_requisicion_enc] [int] IDENTITY(1,1) NOT NULL,
	[fecha_requisicion] [datetime] NULL,
	[codigo_solicitante] [int] NULL,
	[codigo_jefe_dependencia] [int] NULL,
	[usuario_creo] [varchar](20) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](20) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_autorizo] [varchar](50) NULL,
	[fecha_autorizado] [datetime] NULL,
	[codigo_estatus] [int] NULL,
	[observaciones] [varchar](250) NULL,
	[usuario_aprobo] [varchar](20) NULL,
	[fecha_aprobacion] [datetime] NULL,
	[solicitante] [varchar](50) NULL,
	[codigo_dependencia] [int] NULL,
	[usuario_rechazo] [varchar](50) NULL,
	[fecha_rechazo] [datetime] NULL,
	[fecha_despacho] [datetime] NULL,
	[usuario_despacho] [varchar](50) NULL,
	[codigo_grupo] [int] NULL,
	[user_id] [int] NULL,
	[codigo_egreso] [int] NULL,
	[numero_ingresofac] [int] NULL,
 CONSTRAINT [PK_tb_requisicion_enc] PRIMARY KEY CLUSTERED 
(
	[codigo_requisicion_enc] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_requisicion_det]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_requisicion_det](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_requisicion_enc] [int] NOT NULL,
	[codigo_bodega] [int] NOT NULL,
	[codigo_producto] [int] NOT NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
	[cantidad_solicitada] [float] NULL,
	[cantidad_autorizada] [float] NULL,
	[codigo_empresa] [int] NULL,
	[codigo_renglon] [int] NULL,
 CONSTRAINT [PK_tb_requisicion_det] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC,
	[codigo_requisicion_enc] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Tb_Jefes_Depen]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Tb_Jefes_Depen](
	[codigo_jefe_depen] [int] NOT NULL,
	[Nombre_Jefe_Depen] [nvarchar](75) NULL,
	[Codigo_Dependencia] [int] NULL,
	[codigo_usuario] [int] NULL,
	[codigo_grupo] [int] NULL,
	[activo] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[tb_inventario_det]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_inventario_det](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_bodega] [int] NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
	[codigo_producto] [int] NULL,
	[existencia] [int] NULL,
	[lote] [varchar](50) NULL,
	[fecha_vence] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_empresa] [int] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_actividad]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_actividad](
	[codigo_actividad] [int] NOT NULL,
	[codigo_programa] [int] NOT NULL,
	[descripcion] [varchar](100) NULL,
 CONSTRAINT [PK_tb_actividad] PRIMARY KEY CLUSTERED 
(
	[codigo_actividad] ASC,
	[codigo_programa] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  UserDefinedFunction [dbo].[fnCustomPass]    Script Date: 10/10/2017 15:02:15 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE FUNCTION [dbo].[fnCustomPass] 
(    
    @size AS INT, --Tamaño de la cadena aleatoria
    @op AS VARCHAR(2) --Opción para letras(ABC..), numeros(123...) o ambos.
)
RETURNS VARCHAR(62)
AS
BEGIN    

    DECLARE @chars AS VARCHAR(52),
            @numbers AS VARCHAR(10),
            @strChars AS VARCHAR(62),        
            @strPass AS VARCHAR(62),
            @index AS INT,
            @cont AS INT

    SET @strPass = ''
    SET @strChars = ''    
    SET @chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
    SET @numbers = '0123456789'

    SET @strChars = CASE @op WHEN 'C' THEN @chars --Letras
                        WHEN 'N' THEN @numbers --Números
                        WHEN 'CN' THEN @chars + @numbers --Ambos (Letras y Números)
                        ELSE '------'
                    END

    SET @cont = 0
    WHILE @cont < @size
    BEGIN
        SET @index = ceiling( ( SELECT rnd FROM vwRandom ) * (len(@strChars)))--Uso de la vista para el Rand() y no generar error.
        SET @strPass = @strPass + substring(@strChars, @index, 1)
        SET @cont = @cont + 1
    END    
        
    RETURN @strPass

END
GO
/****** Object:  Table [dbo].[fecha]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[fecha](
	[id_fecha] [int] NOT NULL,
	[dia] [int] NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[empleado]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[empleado](
	[idempleado] [numeric](11, 0) NOT NULL,
	[nombres] [char](32) NOT NULL,
	[departamento] [char](40) NOT NULL,
	[sueldo] [numeric](18, 0) NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[direccion]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[direccion](
	[iddireccion] [int] NOT NULL,
	[nombre] [varchar](100) NOT NULL,
	[siglas] [varchar](10) NULL,
	[direccion] [varchar](100) NULL,
	[correlativo] [int] NULL,
	[id_institucion_reg_it] [int] NULL,
	[fecha_registro] [datetime] NULL,
	[id_asesor_registro] [int] NULL,
	[nivel] [decimal](18, 0) NULL,
	[usuario_creo] [varchar](20) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](20) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](20) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[idviceministerio] [int] NULL,
	[id_jefe] [int] NULL
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_usuario_empresa]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_usuario_empresa](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_usuario] [int] NULL,
	[nombre] [varchar](50) NULL,
	[codigo_empresa] [int] NULL,
	[codigo_grupo] [int] NULL,
 CONSTRAINT [PK_cat_usuario_empresa] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_tipo_movimiento]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_tipo_movimiento](
	[codigo_tipo_movimiento] [int] IDENTITY(1,1) NOT NULL,
	[tipo_movimiento] [varchar](50) NULL,
	[activo] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
 CONSTRAINT [PK_cat_tipo_movimiento] PRIMARY KEY CLUSTERED 
(
	[codigo_tipo_movimiento] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_tipo_documento]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_tipo_documento](
	[codigo_tipo_documento] [int] IDENTITY(1,1) NOT NULL,
	[codigo_tipo_movimiento] [int] NULL,
	[tipo_documento] [varchar](50) NULL,
	[activo] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
 CONSTRAINT [PK_cat_tipo_documento] PRIMARY KEY CLUSTERED 
(
	[codigo_tipo_documento] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[cat_subcategoria]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_subcategoria](
	[codigo_subcategoria] [int] NOT NULL,
	[codigo_categoria] [int] NOT NULL,
	[subcategoria] [varchar](100) NULL,
	[activo] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[rowid] [int] IDENTITY(1,1) NOT NULL,
 CONSTRAINT [PK_cat_subcategoria] PRIMARY KEY CLUSTERED 
(
	[codigo_subcategoria] ASC,
	[codigo_categoria] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_categoria_x_bodega]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[tb_categoria_x_bodega](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_bodega] [int] NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
 CONSTRAINT [PK_tb_categoria_x_bodega] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[cat_producto]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[cat_producto](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_categoria] [int] NOT NULL,
	[codigo_subcategoria] [int] NOT NULL,
	[codigo_producto] [int] NOT NULL,
	[producto] [varchar](256) NULL,
	[marca] [varchar](100) NULL,
	[codigo_medida] [int] NULL,
	[codigo_estado] [int] NULL,
	[punto_reorden] [int] NULL,
	[existencia_maxima] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[uso] [varchar](500) NULL,
	[codigo_renglon] [int] NULL,
	[codigo_fiscal] [int] NULL,
 CONSTRAINT [PK_cat_producto] PRIMARY KEY CLUSTERED 
(
	[codigo_categoria] ASC,
	[codigo_subcategoria] ASC,
	[codigo_producto] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_egreso_enc]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_egreso_enc](
	[codigo_egreso_enc] [int] IDENTITY(1,1) NOT NULL,
	[tipo_documento] [int] NULL,
	[fecha_documento] [datetime] NULL,
	[numero_documento] [int] NULL,
	[solicitante] [int] NULL,
	[pariente] [int] NULL,
	[observaciones] [varchar](500) NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_estatus] [int] NULL,
	[codigo_dependencia] [int] NULL,
	[nombre_solicitante] [varchar](50) NULL,
	[recibe] [varchar](50) NULL,
 CONSTRAINT [PK_tb_egreso_enc] PRIMARY KEY CLUSTERED 
(
	[codigo_egreso_enc] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_ingreso_enc]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_ingreso_enc](
	[codigo_ingreso_enc] [int] IDENTITY(5,1) NOT NULL,
	[no_ingreso] [int] NULL,
	[codigo_tipo_documento] [int] NULL,
	[fecha_documento] [datetime] NULL,
	[numero_documento] [varchar](20) NULL,
	[numero_requisicion] [varchar](50) NULL,
	[fecha_requisicion] [datetime] NULL,
	[usuario_solicitante] [int] NULL,
	[solicitante] [varchar](50) NULL,
	[dependencia] [int] NULL,
	[observaciones] [text] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_proveedor] [int] NULL,
	[fecha_recepcion] [datetime] NULL,
	[codigo_actividad] [int] NULL,
	[fecha_ingreso] [datetime] NULL,
	[codigo_programa] [int] NULL,
	[codigo_dependencia] [int] NULL,
	[folio_libro] [int] NULL,
	[nomenclatura_cuentas] [int] NULL,
	[numero_serie] [varchar](50) NULL,
	[userfile] [varchar](500) NULL,
	[codigo_empresa] [int] NULL,
	[codigo_bodega] [int] NULL,
	[codigo_estatus] [int] NULL,
	[justificacion] [text] NULL,
 CONSTRAINT [PK_tb_ingreso_enc] PRIMARY KEY CLUSTERED 
(
	[codigo_ingreso_enc] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_reorden_xproducto]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_reorden_xproducto](
	[codigo_producto] [int] NOT NULL,
	[codigo_bodega] [int] NOT NULL,
	[codigo_categoria] [int] NOT NULL,
	[codigo_subcategoria] [int] NOT NULL,
	[punto_reorden] [int] NULL,
	[existencia_maxima] [int] NULL,
	[estanteria] [varchar](20) NULL,
	[seccion] [varchar](20) NULL,
 CONSTRAINT [PK_tb_reorden_xproducto] PRIMARY KEY CLUSTERED 
(
	[codigo_producto] ASC,
	[codigo_bodega] ASC,
	[codigo_categoria] ASC,
	[codigo_subcategoria] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_ingreso_det]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_ingreso_det](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_ingreso_enc] [int] NOT NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
	[codigo_producto] [int] NOT NULL,
	[cantidad_ingresada] [float] NULL,
	[costo_unidad] [decimal](18, 2) NULL,
	[Precio_total] [decimal](18, 2) NULL,
	[fecha_vence] [datetime] NULL,
	[cantidad_solicitada] [int] NULL,
	[codigo_bodega] [int] NOT NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](50) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_renglon] [int] NULL,
	[codigo_empresa] [int] NULL,
 CONSTRAINT [PK_tb_ingreso_det] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC,
	[codigo_ingreso_enc] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_producto_egresa_det]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_producto_egresa_det](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
	[codigo_producto] [int] NULL,
	[codigo_bodega] [int] NULL,
	[lote] [varchar](50) NULL,
	[fecha_vence] [varchar](25) NULL,
	[entregado] [int] NULL,
	[fecha_operado] [datetime] NULL,
	[numero_documento] [int] NULL,
	[tipo_documento] [int] NULL,
 CONSTRAINT [PK_tb_producto_egresa_det] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_kardex]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_kardex](
	[codigo_kardex] [int] IDENTITY(1,1) NOT NULL,
	[codigo_bodega] [int] NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
	[codigo_producto] [int] NULL,
	[codigo_movimiento] [int] NULL,
	[codigo_tipo_movimiento] [int] NULL,
	[fecha_creado] [datetime] NULL,
	[cantidad] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](100) NULL,
	[fecha_desactivado] [datetime] NULL,
	[activo] [int] NULL,
	[codigo_empresa] [int] NULL,
	[no_despacho] [int] NULL,
	[no_ingreso] [int] NULL,
	[costo_promedio] [decimal](24, 2) NULL,
	[costo_factura] [decimal](24, 2) NULL,
	[costo_movimiento] [decimal](24, 2) NULL,
	[id_dependencia] [int] NULL,
	[entrada] [int] NULL,
	[salida] [int] NULL,
	[saldo] [int] NULL,
	[costo_total] [decimal](24, 2) NULL,
	[costo_actual] [decimal](24, 2) NULL,
	[no_requisicion] [int] NULL,
	[observaciones] [char](100) NULL,
 CONSTRAINT [PK_tb_kardex] PRIMARY KEY CLUSTERED 
(
	[codigo_kardex] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_inventario]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_inventario](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_bodega] [int] NOT NULL,
	[codigo_categoria] [int] NOT NULL,
	[codigo_subcategoria] [int] NOT NULL,
	[codigo_producto] [int] NOT NULL,
	[existencia] [int] NULL,
	[ultimo_ingreso] [datetime] NULL,
	[ultimo_egreso] [datetime] NULL,
	[usuario_ingreso] [varchar](25) NULL,
	[usuario_egreso] [varchar](25) NULL,
	[cantidad_comprometida] [int] NULL,
	[costo_inicial] [decimal](18, 2) NULL,
	[costo_promedio] [decimal](18, 2) NULL,
	[ultimo_costo] [decimal](18, 2) NULL,
	[saldo_inicial] [int] NULL,
	[codigo_empresa] [int] NULL,
	[usuario_rechazo] [varchar](50) NULL,
	[fecha_reingreso] [datetime] NULL,
 CONSTRAINT [PK_tb_inventario] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  Table [dbo].[tb_egreso_det]    Script Date: 10/10/2017 15:02:13 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[tb_egreso_det](
	[rowid] [int] IDENTITY(1,1) NOT NULL,
	[codigo_egreso_enc] [int] NOT NULL,
	[codigo_categoria] [int] NULL,
	[codigo_subcategoria] [int] NULL,
	[codigo_producto] [int] NOT NULL,
	[codigo_bodega] [int] NOT NULL,
	[dosis] [varchar](150) NULL,
	[cantidad_entregada] [float] NULL,
	[cantidad_recetada] [int] NULL,
	[usuario_creo] [varchar](25) NULL,
	[fecha_creado] [datetime] NULL,
	[usuario_modifico] [varchar](25) NULL,
	[fecha_modificado] [datetime] NULL,
	[usuario_desactivo] [varchar](25) NULL,
	[fecha_desactivo] [datetime] NULL,
	[activo] [int] NULL,
	[costo_promedio] [decimal](18, 2) NULL,
	[cantidad_solicitada] [int] NULL,
	[codigo_empresa] [int] NULL,
 CONSTRAINT [PK_tb_egreso_det] PRIMARY KEY CLUSTERED 
(
	[rowid] ASC,
	[codigo_egreso_enc] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO
/****** Object:  View [dbo].[view_inventario]    Script Date: 10/10/2017 15:02:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_inventario]
AS
SELECT     TOP 100 PERCENT dbo.cat_producto.producto + ' ' + dbo.cat_producto.marca + ' ' + dbo.cat_medida.unidad_medida AS descripcion, 
                      dbo.cat_subcategoria.subcategoria, dbo.cat_categoria.categoria, dbo.cat_categoria.codigo_categoria, dbo.cat_subcategoria.codigo_subcategoria, 
                      dbo.cat_producto.codigo_producto, dbo.tb_categoria_x_bodega.codigo_bodega
FROM         dbo.cat_producto INNER JOIN
                      dbo.cat_categoria ON dbo.cat_producto.codigo_categoria = dbo.cat_categoria.codigo_categoria INNER JOIN
                      dbo.cat_subcategoria ON dbo.cat_producto.codigo_subcategoria = dbo.cat_subcategoria.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_categoria = dbo.cat_subcategoria.codigo_categoria AND 
                      dbo.cat_categoria.codigo_categoria = dbo.cat_subcategoria.codigo_categoria INNER JOIN
                      dbo.cat_medida ON dbo.cat_producto.codigo_medida = dbo.cat_medida.codigo_medida INNER JOIN
                      dbo.tb_categoria_x_bodega ON dbo.cat_categoria.codigo_categoria = dbo.tb_categoria_x_bodega.codigo_categoria AND 
                      dbo.cat_subcategoria.codigo_subcategoria = dbo.tb_categoria_x_bodega.codigo_subcategoria
ORDER BY dbo.cat_producto.codigo_producto
GO
/****** Object:  View [dbo].[view_entregado_det]    Script Date: 10/10/2017 15:02:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_entregado_det]
AS
SELECT     dbo.cat_producto.producto + ' ' + dbo.cat_producto.marca + ' ' + dbo.cat_medida.unidad_medida AS producto, dbo.tb_producto_egresa_det.lote, 
                      dbo.tb_producto_egresa_det.fecha_vence, dbo.tb_producto_egresa_det.entregado, dbo.tb_producto_egresa_det.numero_documento
FROM         dbo.cat_producto INNER JOIN
                      dbo.cat_medida ON dbo.cat_producto.codigo_medida = dbo.cat_medida.codigo_medida INNER JOIN
                      dbo.tb_producto_egresa_det ON dbo.cat_producto.codigo_categoria = dbo.tb_producto_egresa_det.codigo_categoria AND 
                      dbo.cat_producto.codigo_subcategoria = dbo.tb_producto_egresa_det.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_producto = dbo.tb_producto_egresa_det.codigo_producto
GO
/****** Object:  View [dbo].[view_despacho]    Script Date: 10/10/2017 15:02:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_despacho]
AS
SELECT     dbo.cat_producto.producto + ' ' + dbo.cat_producto.marca AS descripcion, dbo.cat_medida.unidad_medida, dbo.tb_ingreso_det.cantidad_solicitada, 
                      dbo.tb_ingreso_det.cantidad_ingresada, dbo.tb_ingreso_det.codigo_ingreso_enc, dbo.tb_ingreso_det.codigo_producto, 
                      dbo.tb_ingreso_det.codigo_subcategoria, dbo.tb_ingreso_det.codigo_categoria, dbo.tb_ingreso_det.usuario_creo, 
                      dbo.tb_ingreso_det.fecha_creado
FROM         dbo.cat_producto INNER JOIN
                      dbo.cat_medida ON dbo.cat_producto.codigo_medida = dbo.cat_medida.codigo_medida INNER JOIN
                      dbo.tb_ingreso_det ON dbo.cat_producto.codigo_categoria = dbo.tb_ingreso_det.codigo_categoria AND 
                      dbo.cat_producto.codigo_subcategoria = dbo.tb_ingreso_det.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_producto = dbo.tb_ingreso_det.codigo_producto
GO
/****** Object:  View [dbo].[view_vencimiento]    Script Date: 10/10/2017 15:02:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_vencimiento]
AS
SELECT     dbo.cat_producto.producto + ' ' + dbo.cat_producto.marca + ' ' + dbo.cat_medida.unidad_medida AS descripcion, dbo.cat_categoria.categoria, 
                      dbo.cat_subcategoria.subcategoria, dbo.tb_inventario_det.existencia, dbo.tb_inventario_det.fecha_vence AS fecha, 
                      dbo.tb_inventario_det.codigo_bodega, dbo.cat_producto.codigo_categoria, dbo.cat_producto.codigo_subcategoria, dbo.cat_producto.codigo_producto, 
                      GETDATE() AS operado
FROM         dbo.cat_producto INNER JOIN
                      dbo.tb_inventario ON dbo.cat_producto.codigo_categoria = dbo.tb_inventario.codigo_categoria AND 
                      dbo.cat_producto.codigo_subcategoria = dbo.tb_inventario.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_producto = dbo.tb_inventario.codigo_producto INNER JOIN
                      dbo.tb_inventario_det ON dbo.tb_inventario.codigo_bodega = dbo.tb_inventario_det.codigo_bodega AND 
                      dbo.tb_inventario.codigo_categoria = dbo.tb_inventario_det.codigo_categoria AND 
                      dbo.tb_inventario.codigo_subcategoria = dbo.tb_inventario_det.codigo_subcategoria AND 
                      dbo.tb_inventario.codigo_producto = dbo.tb_inventario_det.codigo_producto INNER JOIN
                      dbo.cat_medida ON dbo.cat_producto.codigo_medida = dbo.cat_medida.codigo_medida INNER JOIN
                      dbo.cat_categoria ON dbo.cat_producto.codigo_categoria = dbo.cat_categoria.codigo_categoria INNER JOIN
                      dbo.cat_subcategoria ON dbo.cat_producto.codigo_subcategoria = dbo.cat_subcategoria.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_categoria = dbo.cat_subcategoria.codigo_categoria AND 
                      dbo.cat_categoria.codigo_categoria = dbo.cat_subcategoria.codigo_categoria
GO
/****** Object:  View [dbo].[view_receta]    Script Date: 10/10/2017 15:02:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_receta]
AS
SELECT     dbo.cat_producto.producto + ' ' + dbo.cat_producto.marca + ' ' + dbo.cat_medida.unidad_medida AS producto, dbo.tb_egreso_det.codigo_egreso_enc, 
                      dbo.tb_egreso_det.dosis, dbo.tb_egreso_det.cantidad_entregada, dbo.tb_egreso_det.cantidad_recetada, dbo.tb_egreso_det.usuario_creo, 
                      dbo.tb_egreso_det.fecha_creado
FROM         dbo.cat_producto INNER JOIN
                      dbo.tb_egreso_det ON dbo.cat_producto.codigo_categoria = dbo.tb_egreso_det.codigo_categoria AND 
                      dbo.cat_producto.codigo_subcategoria = dbo.tb_egreso_det.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_producto = dbo.tb_egreso_det.codigo_producto INNER JOIN
                      dbo.cat_medida ON dbo.cat_producto.codigo_medida = dbo.cat_medida.codigo_medida
GO
/****** Object:  View [dbo].[view_kardex]    Script Date: 10/10/2017 15:02:16 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE VIEW [dbo].[view_kardex]
AS
SELECT     TOP 100 PERCENT dbo.cat_producto.producto + ' ' + dbo.cat_producto.marca + ' ' + dbo.cat_medida.unidad_medida AS descripcion, 
                      dbo.tb_kardex.codigo_bodega, dbo.tb_kardex.codigo_movimiento, dbo.tb_kardex.codigo_tipo_movimiento, dbo.tb_kardex.fecha, 
                      dbo.tb_kardex.cantidad, dbo.tb_kardex.usuario_creo, dbo.tb_kardex.fecha_creado, dbo.cat_subcategoria.subcategoria, dbo.cat_categoria.categoria, 
                      dbo.cat_categoria.codigo_categoria, dbo.cat_subcategoria.codigo_subcategoria, dbo.cat_producto.codigo_producto
FROM         dbo.cat_producto INNER JOIN
                      dbo.cat_categoria ON dbo.cat_producto.codigo_categoria = dbo.cat_categoria.codigo_categoria INNER JOIN
                      dbo.cat_subcategoria ON dbo.cat_producto.codigo_subcategoria = dbo.cat_subcategoria.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_categoria = dbo.cat_subcategoria.codigo_categoria AND 
                      dbo.cat_categoria.codigo_categoria = dbo.cat_subcategoria.codigo_categoria INNER JOIN
                      dbo.tb_kardex ON dbo.cat_producto.codigo_categoria = dbo.tb_kardex.codigo_categoria AND 
                      dbo.cat_producto.codigo_subcategoria = dbo.tb_kardex.codigo_subcategoria AND 
                      dbo.cat_producto.codigo_producto = dbo.tb_kardex.codigo_producto INNER JOIN
                      dbo.cat_medida ON dbo.cat_producto.codigo_medida = dbo.cat_medida.codigo_medida
ORDER BY descripcion, dbo.tb_kardex.fecha
GO
/****** Object:  ForeignKey [FK_cat_producto_cat_estadoproducto]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[cat_producto]  WITH NOCHECK ADD  CONSTRAINT [FK_cat_producto_cat_estadoproducto] FOREIGN KEY([codigo_estado])
REFERENCES [dbo].[cat_estadoproducto] ([codigo_estado])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[cat_producto] CHECK CONSTRAINT [FK_cat_producto_cat_estadoproducto]
GO
/****** Object:  ForeignKey [FK_cat_producto_cat_medida]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[cat_producto]  WITH NOCHECK ADD  CONSTRAINT [FK_cat_producto_cat_medida] FOREIGN KEY([codigo_medida])
REFERENCES [dbo].[cat_medida] ([codigo_medida])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[cat_producto] CHECK CONSTRAINT [FK_cat_producto_cat_medida]
GO
/****** Object:  ForeignKey [FK_cat_producto_cat_subcategoria]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[cat_producto]  WITH NOCHECK ADD  CONSTRAINT [FK_cat_producto_cat_subcategoria] FOREIGN KEY([codigo_subcategoria], [codigo_categoria])
REFERENCES [dbo].[cat_subcategoria] ([codigo_subcategoria], [codigo_categoria])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[cat_producto] CHECK CONSTRAINT [FK_cat_producto_cat_subcategoria]
GO
/****** Object:  ForeignKey [FK_cat_subcategoria_cat_categoria]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[cat_subcategoria]  WITH CHECK ADD  CONSTRAINT [FK_cat_subcategoria_cat_categoria] FOREIGN KEY([codigo_categoria])
REFERENCES [dbo].[cat_categoria] ([codigo_categoria])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[cat_subcategoria] CHECK CONSTRAINT [FK_cat_subcategoria_cat_categoria]
GO
/****** Object:  ForeignKey [FK_cat_tipo_documento_cat_tipo_movimiento]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[cat_tipo_documento]  WITH CHECK ADD  CONSTRAINT [FK_cat_tipo_documento_cat_tipo_movimiento] FOREIGN KEY([codigo_tipo_movimiento])
REFERENCES [dbo].[cat_tipo_movimiento] ([codigo_tipo_movimiento])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[cat_tipo_documento] CHECK CONSTRAINT [FK_cat_tipo_documento_cat_tipo_movimiento]
GO
/****** Object:  ForeignKey [FK_tb_categoria_x_bodega_cat_bodega]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_categoria_x_bodega]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_categoria_x_bodega_cat_bodega] FOREIGN KEY([codigo_bodega])
REFERENCES [dbo].[cat_bodega] ([codigo_bodega])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_categoria_x_bodega] CHECK CONSTRAINT [FK_tb_categoria_x_bodega_cat_bodega]
GO
/****** Object:  ForeignKey [FK_tb_categoria_x_bodega_cat_categoria]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_categoria_x_bodega]  WITH CHECK ADD  CONSTRAINT [FK_tb_categoria_x_bodega_cat_categoria] FOREIGN KEY([codigo_categoria])
REFERENCES [dbo].[cat_categoria] ([codigo_categoria])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_categoria_x_bodega] CHECK CONSTRAINT [FK_tb_categoria_x_bodega_cat_categoria]
GO
/****** Object:  ForeignKey [FK_tb_egreso_det_cat_bodega]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_egreso_det]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_egreso_det_cat_bodega] FOREIGN KEY([codigo_bodega])
REFERENCES [dbo].[cat_bodega] ([codigo_bodega])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_egreso_det] CHECK CONSTRAINT [FK_tb_egreso_det_cat_bodega]
GO
/****** Object:  ForeignKey [FK_tb_egreso_det_cat_producto]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_egreso_det]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_egreso_det_cat_producto] FOREIGN KEY([codigo_categoria], [codigo_subcategoria], [codigo_producto])
REFERENCES [dbo].[cat_producto] ([codigo_categoria], [codigo_subcategoria], [codigo_producto])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_egreso_det] CHECK CONSTRAINT [FK_tb_egreso_det_cat_producto]
GO
/****** Object:  ForeignKey [FK_tb_egreso_enc_cat_tipo_documento]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_egreso_enc]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_egreso_enc_cat_tipo_documento] FOREIGN KEY([tipo_documento])
REFERENCES [dbo].[cat_tipo_documento] ([codigo_tipo_documento])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_egreso_enc] CHECK CONSTRAINT [FK_tb_egreso_enc_cat_tipo_documento]
GO
/****** Object:  ForeignKey [FK_tb_ingreso_det_cat_bodega]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_ingreso_det]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_ingreso_det_cat_bodega] FOREIGN KEY([codigo_bodega])
REFERENCES [dbo].[cat_bodega] ([codigo_bodega])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_ingreso_det] CHECK CONSTRAINT [FK_tb_ingreso_det_cat_bodega]
GO
/****** Object:  ForeignKey [FK_tb_ingreso_det_cat_producto]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_ingreso_det]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_ingreso_det_cat_producto] FOREIGN KEY([codigo_categoria], [codigo_subcategoria], [codigo_producto])
REFERENCES [dbo].[cat_producto] ([codigo_categoria], [codigo_subcategoria], [codigo_producto])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_ingreso_det] CHECK CONSTRAINT [FK_tb_ingreso_det_cat_producto]
GO
/****** Object:  ForeignKey [FK_tb_ingreso_enc_cat_tipo_documento]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_ingreso_enc]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_ingreso_enc_cat_tipo_documento] FOREIGN KEY([codigo_tipo_documento])
REFERENCES [dbo].[cat_tipo_documento] ([codigo_tipo_documento])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_ingreso_enc] CHECK CONSTRAINT [FK_tb_ingreso_enc_cat_tipo_documento]
GO
/****** Object:  ForeignKey [FK_tb_inventario_cat_bodega]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_inventario]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_inventario_cat_bodega] FOREIGN KEY([codigo_bodega])
REFERENCES [dbo].[cat_bodega] ([codigo_bodega])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_inventario] CHECK CONSTRAINT [FK_tb_inventario_cat_bodega]
GO
/****** Object:  ForeignKey [FK_tb_inventario_cat_producto]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_inventario]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_inventario_cat_producto] FOREIGN KEY([codigo_categoria], [codigo_subcategoria], [codigo_producto])
REFERENCES [dbo].[cat_producto] ([codigo_categoria], [codigo_subcategoria], [codigo_producto])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_inventario] CHECK CONSTRAINT [FK_tb_inventario_cat_producto]
GO
/****** Object:  ForeignKey [FK_tb_kardex_cat_bodega]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_kardex]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_kardex_cat_bodega] FOREIGN KEY([codigo_bodega])
REFERENCES [dbo].[cat_bodega] ([codigo_bodega])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_kardex] CHECK CONSTRAINT [FK_tb_kardex_cat_bodega]
GO
/****** Object:  ForeignKey [FK_tb_kardex_cat_producto]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_kardex]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_kardex_cat_producto] FOREIGN KEY([codigo_categoria], [codigo_subcategoria], [codigo_producto])
REFERENCES [dbo].[cat_producto] ([codigo_categoria], [codigo_subcategoria], [codigo_producto])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_kardex] CHECK CONSTRAINT [FK_tb_kardex_cat_producto]
GO
/****** Object:  ForeignKey [FK_tb_kardex_cat_tipo_movimiento]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_kardex]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_kardex_cat_tipo_movimiento] FOREIGN KEY([codigo_tipo_movimiento])
REFERENCES [dbo].[cat_tipo_movimiento] ([codigo_tipo_movimiento])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_kardex] CHECK CONSTRAINT [FK_tb_kardex_cat_tipo_movimiento]
GO
/****** Object:  ForeignKey [FK_tb_producto_egresa_det_cat_producto]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_producto_egresa_det]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_producto_egresa_det_cat_producto] FOREIGN KEY([codigo_categoria], [codigo_subcategoria], [codigo_producto])
REFERENCES [dbo].[cat_producto] ([codigo_categoria], [codigo_subcategoria], [codigo_producto])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_producto_egresa_det] CHECK CONSTRAINT [FK_tb_producto_egresa_det_cat_producto]
GO
/****** Object:  ForeignKey [FK_tb_producto_egresa_det_cat_tipo_documento]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_producto_egresa_det]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_producto_egresa_det_cat_tipo_documento] FOREIGN KEY([tipo_documento])
REFERENCES [dbo].[cat_tipo_documento] ([codigo_tipo_documento])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_producto_egresa_det] CHECK CONSTRAINT [FK_tb_producto_egresa_det_cat_tipo_documento]
GO
/****** Object:  ForeignKey [FK_tb_reorden_xproducto_cat_bodega]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_reorden_xproducto]  WITH CHECK ADD  CONSTRAINT [FK_tb_reorden_xproducto_cat_bodega] FOREIGN KEY([codigo_bodega])
REFERENCES [dbo].[cat_bodega] ([codigo_bodega])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_reorden_xproducto] CHECK CONSTRAINT [FK_tb_reorden_xproducto_cat_bodega]
GO
/****** Object:  ForeignKey [FK_tb_reorden_xproducto_cat_bodega1]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_reorden_xproducto]  WITH CHECK ADD  CONSTRAINT [FK_tb_reorden_xproducto_cat_bodega1] FOREIGN KEY([codigo_bodega])
REFERENCES [dbo].[cat_bodega] ([codigo_bodega])
GO
ALTER TABLE [dbo].[tb_reorden_xproducto] CHECK CONSTRAINT [FK_tb_reorden_xproducto_cat_bodega1]
GO
/****** Object:  ForeignKey [FK_tb_reorden_xproducto_cat_producto]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_reorden_xproducto]  WITH NOCHECK ADD  CONSTRAINT [FK_tb_reorden_xproducto_cat_producto] FOREIGN KEY([codigo_producto], [codigo_categoria], [codigo_subcategoria])
REFERENCES [dbo].[cat_producto] ([codigo_categoria], [codigo_subcategoria], [codigo_producto])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[tb_reorden_xproducto] CHECK CONSTRAINT [FK_tb_reorden_xproducto_cat_producto]
GO
/****** Object:  ForeignKey [FK_tb_requisicion_enc_tb_requisicion_enc]    Script Date: 10/10/2017 15:02:13 ******/
ALTER TABLE [dbo].[tb_requisicion_enc]  WITH CHECK ADD  CONSTRAINT [FK_tb_requisicion_enc_tb_requisicion_enc] FOREIGN KEY([codigo_requisicion_enc])
REFERENCES [dbo].[tb_requisicion_enc] ([codigo_requisicion_enc])
GO
ALTER TABLE [dbo].[tb_requisicion_enc] CHECK CONSTRAINT [FK_tb_requisicion_enc_tb_requisicion_enc]
GO
