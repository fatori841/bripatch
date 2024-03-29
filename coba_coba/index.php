<!DOCTYPE html>
<html>
<head>
	<title>BRIPATCH</title>
</head>
<body>
	<h2>iBBIZ</h2>
	
	<p><a href="index.php">Beranda</a> / <a href="index.php">Tampilkan Data</a></p>
	
	<h3>Buka Blokir iBBIZ</h3>
	
	<table cellpadding="5" cellspacing="0" border="1">
		<tr bgcolor="#84DFFF">
			<th>Id</th>
			<th>Handle</th>
			<th>Title</th>
			<th>Name</th>
			<th>Created Date</th>
            <th>Last Update</th>
            <th>Gender</th>
			<th>Position</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Handphone</th>
            <th>Id type</th>
            <th>Id Number</th>
			<th>Id Expired</th>
			<th>Address</th>
			<th>USRTYPE</th>
			<th>Last Login</th>
            <th>Last Logout</th>
            <th>Password</th>
			<th>SALT</th>
			<th>Prev Password</th>
			<th>Exp Password</th>
			<th>Wrong Password</th>
            <th>Login</th>
            <th>Status</th>
			<th>Description</th>
            <th>Cookie</th>
            <th>Action</th>
		</tr>
		
		<?php
		//iclude file koneksi ke database
		include('config.php');
		
		//query ke database dg SELECT table siswa diurutkan berdasarkan NIS paling besar
		$query = mysqli_query($db, "SELECT * FROM user ORDER BY id DESC") or die(mysql_error());
		
		//cek, apakakah hasil query di atas mendapatkan hasil atau tidak (data kosong atau tidak)
		if(mysqli_num_rows($query) == 0){	//ini artinya jika data hasil query di atas kosong
			
			//jika data kosong, maka akan menampilkan row kosong
			echo '<tr><td colspan="6">Tidak ada data!</td></tr>';
			
		}else{	//else ini artinya jika data hasil query ada (data diu database tidak kosong)
			
			//jika data tidak kosong, maka akan melakukan perulangan while
			$no = 1;	//membuat variabel $no untuk membuat nomor urut
			while($data = mysqli_fetch_assoc($query)){	//perulangan while dg membuat variabel $data yang akan mengambil data di database
				
				//menampilkan row dengan data di database
				echo '<tr>';
                    echo'<td>'.$data['id'].'</td>';
                    echo'<td>'.$data['handle'].'</td>';
                    echo'<td>'.$data['title'].'</td>';
                    echo'<td>'.$data['name'].'</td>';
                    echo'<td>'.$data['CREATEDDATE'].'</td>';
                    echo'<td>'.$data['lastupdate'].'</td>';
                    echo'<td>'.$data['gender'].'</td>';
                    echo'<td>'.$data['position'].'</td>';
                    echo'<td>'.$data['email'].'</td>';
                    echo'<td>'.$data['phone'].'</td>';
                    echo'<td>'.$data['handphone'].'</td>';
                    echo'<td>'.$data['idtype'].'</td>';
                    echo'<td>'.$data['idnumber'].'</td>';
                    echo'<td>'.$data['idexpired'].'</td>';
                    echo'<td>'.$data['address'].'</td>';
                    echo'<td>'.$data['USRTYPE'].'</td>';
                    echo'<td>'.$data['lastlogin'].'</td>';
                    echo'<td>'.$data['lastlogout'].'</td>';
                    echo'<td>'.$data['password'].'</td>';
                    echo'<td>'.$data['SALT'].'</td>';
                    echo'<td>'.$data['prevpassword'].'</td>';
                    echo'<td>'.$data['exppassword'].'</td>';
                    echo'<td>'.$data['wrgpassword'].'</td>';
                    echo'<td>'.$data['login'].'</td>';
                    echo'<td>'.$data['status'].'</td>';
                    echo'<td>'.$data['description'].'</td>';
                    echo'<td>'.$data['cookie'].'</td>';
					echo '<td><a href="edit.php?id='.$data['id'].'">Edit</a></td>';	//menampilkan link edit dan hapus dimana tiap link terdapat GET id -> ?id=id
				echo '</tr>';
				
				$no++;	//menambah jumlah nomor urut setiap row
				
			}
			
		}
		?>
	</table>
</body>
</html>