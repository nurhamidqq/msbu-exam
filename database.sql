USE [exam]
create table produk (
	id int IDENTITY(1,1) PRIMARY KEY(id),
	nama_barang varchar(200) not null,
	kode_barang varchar(50) not null,
	jumlah_barang int not null,
	tanggal datetime not null,
);

USE [exam]
insert into produk (nama_barang,kode_barang,jumlah_barang,tanggal) values ('Baju A','KD001',10,'2023-09-24 08:00:00'),('Baju B','KD002',15,'2023-09-24 08:00:00'),('Celana A','KD003',50,'2023-09-24 08:00:00');


USE [exam]
GO

SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE AllinOne
	@id            INT,
	@nama_barang   VARCHAR(200),
	@kode_barang   VARCHAR(50),
	@jumlah_barang INT,
	@tanggal       DATETIME,
	@StatementType NVARCHAR(20)

	AS
	  BEGIN
		  IF @StatementType = 'Insert'
			BEGIN
				INSERT INTO produk
							(nama_barang,kode_barang,jumlah_barang,tanggal)
				VALUES     (@nama_barang,@kode_barang,@jumlah_barang,@tanggal)
			END

		  IF @StatementType = 'Select'
			BEGIN
				SELECT *
				FROM   produk
			END

		  IF @StatementType = 'Update'
			BEGIN
				UPDATE produk
				SET    nama_barang = @nama_barang,
					   kode_barang = @kode_barang,
					   jumlah_barang = @jumlah_barang,
					   tanggal = @tanggal
				WHERE  id = @id
			END
		  IF @StatementType = 'Search'
			BEGIN
				SELECT *
				FROM   produk
				WHERE  nama_barang like '%'+@nama_barang+'%'
			END
		  ELSE IF @StatementType = 'Delete'
			BEGIN
				DELETE FROM produk
				WHERE  id = @id
			END
	  END
