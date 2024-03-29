<!DOCTYPE html>
<html>
<head>
	<title>BRIPATCH</title>
</head>
<body>
	<h2>iBBIZ CRUD</h2>
	
	<p><a href="index.php">Beranda</a> / <a href="tambah.php">Edit Data</a></p>
	
	<h3>Edit Data Siswa</h3>
	
	<?php
	//proses mengambil data ke database untuk ditampilkan di form edit berdasarkan siswa_id yg didapatkan dari GET id -> edit.php?id=siswa_id
	
	//include atau memasukkan file koneksi ke database
	include('config.php');
	
	//membuat variabel $id yg nilainya adalah dari URL GET id -> edit.php?id=siswa_id
	$id = $_GET['id'];
	
	//melakukan query ke database dg SELECT table siswa dengan kondisi WHERE siswa_id = '$id'
	$show = mysqli_query($db, "SELECT * FROM user WHERE id='$id'");
	
	//cek apakah data dari hasil query ada atau tidak
	if(mysqli_num_rows($show) == 0){
		
		//jika tidak ada data yg sesuai maka akan langsung di arahkan ke halaman depan atau beranda -> index.php
		echo '<script>window.history.back()</script>';
		
	}else{
	
		//jika data ditemukan, maka membuat variabel $data
		$data = mysqli_fetch_assoc($show);	//mengambil data ke database yang nantinya akan ditampilkan di form edit di bawah
	
	}
	?>
	
	<form action="edit-proses.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">	<!-- membuat inputan hidden dan nilainya adalah siswa_id -->
		<table cellpadding="3" cellspacing="0">
            <tr>
                <td>Id</td>
                <td>:</td>
                <td><?php echo $data['id']; ?></td>
            </tr>
            <tr>
                <td>Handle</td>
                <td>:</td>
                <td><?php echo $data['handle']; ?></td>
            </tr>
            <tr>
                <td>Title</td>
                <td>:</td>
                <td><?php echo $data['title'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td>:</td>
                <td><?php echo $data['name']; ?></td>
            </tr>
            <tr>
                <td>Created Date</td>
                <td>:</td>
                <td><?php echo $data['CREATEDDATE']; ?></td>
            </tr>
            <tr>
                <td>Last Update</td>
                <td>:</td>
                <td><?php echo $data['lastupdate']; ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td><?php echo $data['gender']; ?></td>
            </tr>
            <tr>
                <td>Position</td>
                <td>:</td>
                <td><?php echo $data['position']; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $data['email']; ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $data['phone']; ?></td>
            </tr>
            <tr>
                <td>Handphone</td>
                <td>:</td>
                <td><?php echo $data['handphone']; ?></td>
            </tr>
            <tr>
                <td>Id type</td>
                <td>:</td>
                <td><?php echo $data['idtype']; ?></td>
            </tr>
            <tr>
                <td>Id Number</td>
                <td>:</td>
                <td><?php echo $data['idnumber']; ?></td>
            </tr>
            <tr>
                <td>Id Expired</td>
                <td>:</td>
                <td><?php echo $data['idexpired']; ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $data['address']; ?></td>
            </tr>
            <tr>
                <td>USRTYPE</td>
                <td>:</td>
                <td><?php echo $data['USRTYPE']; ?></td>
            </tr>
            <tr>
                <td>Last Login</td>
                <td>:</td>
                <td><?php echo $data['lastlogin']; ?></td>
            </tr>
            <tr>
                <td>Last Logout</td>
                <td>:</td>
                <td><?php echo $data['lastlogout']; ?></td>
            </tr>
            <tr>
                <td>Password</td>
                <td>:</td>
                <td><?php echo $data['password']; ?></td>
            </tr>
            <tr>
                <td>SALT</td>
                <td>:</td>
                <td><?php echo $data['SALT']; ?></td>
            </tr>
            <tr>
                <td>Prev Password</td>
                <td>:</td>
                <td><?php echo $data['prevpassword']; ?></td>
            </tr>
            <tr>
                <td>Exp Password</td>
                <td>:</td>
                <td><?php echo $data['exppassword']; ?></td>
            </tr>
            <tr>
                <td>Wrong Password</td>
                <td>:</td>
                <td><input type="text" name="wrgpassword" size="30" value="<?php echo $data['wrgpassword']; ?>" required></td> <!-- keep -->
            </tr>
            <tr>
                <td>Login</td>
                <td>:</td>
                <td><?php echo $data['login']; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>:</td>
                <td><input type="text" name="status" size="30" value="<?php echo $data['status']; ?>" required></td> <!-- keep -->
            </tr>
            <tr>
                <td>Description</td>
                <td>:</td>
                <td><input type="text" name="description" size="30" value="<?php echo $data['description']; ?>" required></td> <!-- keep -->
            </tr>
            <tr>
                <td>Cookie</td>
                <td>:</td>
                <td><?php echo $data['cookie']; ?></td>
            </tr>
			<tr>
				<td>&nbsp;</td>
				<td></td>
				<td><input type="submit" name="simpan" value="Simpan"></td>
			</tr>
		</table>
	</form>
</body>
</html>