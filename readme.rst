###################
Code Structure - Update CIF Brimo Bripatch
###################

*******************
Views
*******************
dir : application/views/brimo/cif_patching/
show_cif_patching_user.php
show_cif_patching_user_result.php

**************************
Controllers
**************************

dir : application/controllers/Brimo.php
public function show_cif_patching_user()
public function search_user_cif()
public function edit_user_profile_cif()
public function edit_user_deposito_cif()


*******************
Models
*******************

dir : application/models/Brimo_model.php
public function get_user_cif($data)
public function update_user_profile_cif($data) 
public function update_user_deposito_cif($data)

