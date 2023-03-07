<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$ceks = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']   	 = $this->Mcrud->get_users_by_un($ceks);
			$data['users']  	 = $this->Mcrud->get_users();
			$data['judul_web'] = "Beranda | Aplikasi Manajemen Arsip";

			$this->load->view('users/header', $data);
			$this->load->view('users/beranda', $data);
			$this->load->view('users/footer');

		}
	}

	public function profile()
	{
		$ceks = $this->session->userdata('surat_menyurat@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);
			$data['level_users']  = $this->Mcrud->get_level_users();
			$data['judul_web'] 		= "Profile | Aplikasi Manajemen Arsip";

					$this->load->view('users/header', $data);
					$this->load->view('users/profile', $data);
					$this->load->view('users/footer');

					if (isset($_POST['btnupdate'])) {
						$nama_lengkap	 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$email	 			= htmlentities(strip_tags($this->input->post('email')));
						$alamat	 			= htmlentities(strip_tags($this->input->post('alamat')));
						$telp	 			= htmlentities(strip_tags($this->input->post('telp')));
						$pengalaman	 	 	= htmlentities(strip_tags($this->input->post('pengalaman')));

									$data = array(
										'nama_lengkap'		=> $nama_lengkap,
										'email'				=> $email,
										'alamat'			=> $alamat,
										'telp'				=> $telp,
										'pengalaman'		=> $pengalaman
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Profile berhasil disimpan.
										</div>'
									);
									redirect('users/profile');
					}


					if (isset($_POST['btnupdate2'])) {
						$password 	= htmlentities(strip_tags($this->input->post('password')));
						$password2 	= htmlentities(strip_tags($this->input->post('password2')));

						if ($password != $password2) {
								$this->session->set_flashdata('msg2',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Katasandi tidak cocok.
									</div>'
								);
						}else{
									$data = array(
										'password'	=> md5($password)
									);
									$this->Mcrud->update_user(array('username' => $ceks), $data);

									$this->session->set_flashdata('msg2',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Katasandi berhasil disimpan.
										</div>'
									);
						}
									redirect('users/profile');
					}
		}
	}

	public function pengguna($aksi='', $id='')
	{
		$ceks = $this->session->userdata('surat_menyurat@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'admin' or $data['user']->row()->level == 'user') {
					redirect('404_content');
			}

			$this->db->order_by('id_user', 'DESC');
			$data['level_users']  = $this->Mcrud->get_level_users();

				if ($aksi == 't') {
					$p = "pengguna_tambah";

					$data['judul_web'] 	  = "Tambah Pengguna | Aplikasi Manajemen Arsip";
				}elseif ($aksi == 'd') {
					$p = "pengguna_detail";

					$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
					$data['judul_web'] 	  = "Detail Pengguna | Aplikasi Manajemen Arsip";
				}elseif ($aksi == 'e') {
					$p = "pengguna_edit";

					$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
					$data['judul_web'] 	  = "Edit Pengguna | Aplikasi Manajemen Arsip";

				}elseif ($aksi == 'h') {

					$data['query'] = $this->db->get_where("tbl_user", "id_user = '$id'")->row();
					$data['judul_web'] 	  = "Hapus Pengguna | Aplikasi Manajemen Arsip";

					if ($ceks == $data['query']->username) {
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-warning alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Gagal!</strong> Maaf, Anda tidak bisa menghapus Nama Pengguna "'.$ceks.'" ini.
							</div>'
						);
					}else{
						$this->Mcrud->delete_user_by_id($id);
						$this->session->set_flashdata('msg',
							'
							<div class="alert alert-success alert-dismissible" role="alert">
								 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
									 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
								 </button>
								 <strong>Sukses!</strong> Pengguna berhasil dihapus.
							</div>'
						);
					}
					redirect('users/pengguna');
				}else{
					$p = "pengguna";

					$data['judul_web'] 	  = "Pengguna | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pengaturan/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$username   	 	= htmlentities(strip_tags($this->input->post('username')));
						$password	 		  = htmlentities(strip_tags($this->input->post('password')));
						$password2	 		= htmlentities(strip_tags($this->input->post('password2')));
						$level	 				= htmlentities(strip_tags($this->input->post('level')));

						$cek_user = $this->db->get_where("tbl_user", "username = '$username'")->num_rows();
						if ($cek_user != 0) {
								$this->session->set_flashdata('msg',
									'
									<div class="alert alert-warning alert-dismissible" role="alert">
										 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
											 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
										 </button>
										 <strong>Gagal!</strong> Nama Pengguna "'.$username.'" Sudah ada.
									</div>'
								);
						}else{
								if ($password != $password2) {
										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-warning alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Gagal!</strong> Katasandi tidak cocok.
											</div>'
										);
								}else{
										$data = array(
											'username'	 	 => $username,
											'nama_lengkap' => $username,
											'password'	 	 => md5($password),
											'email' 			 => '-',
											'alamat' 			 => '-',
											'telp' 				 => '-',
											'pengalaman' 	 => '-',
											'status' 			 => 'aktif',
											'level'			 	 => $level,
											'tgl_daftar' 	 => $tgl
										);
										$this->Mcrud->save_user($data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Pengguna berhasil ditambahkan.
											</div>'
										);
								}
						}

									redirect('users/pengguna/t');
					}

					if (isset($_POST['btnupdate'])) {
						$nama_lengkap	 	= htmlentities(strip_tags($this->input->post('nama_lengkap')));
						$email	 				= htmlentities(strip_tags($this->input->post('email')));
						$alamat	 				= htmlentities(strip_tags($this->input->post('alamat')));
						$telp	 					= htmlentities(strip_tags($this->input->post('telp')));
						$pengalaman	 	  = htmlentities(strip_tags($this->input->post('pengalaman')));
						$level	 				= htmlentities(strip_tags($this->input->post('level')));

									$data = array(
										'nama_lengkap' => $nama_lengkap,
										'email'				 => $email,
										'alamat'			 => $alamat,
										'telp'				 => $telp,
										'pengalaman'	  => $pengalaman,
										'status' 			 => 'aktif',
										'level'			 	 => $level,
										'tgl_daftar' 	 => $tgl
									);
									$this->Mcrud->update_user(array('id_user' => $id), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Pengguna berhasil diupdate.
										</div>'
									);
									redirect('users/pengguna');
					}

		}
	}



	public function bagian($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'user') {
					redirect('404_content');
			}

			$this->db->join('tbl_user', 'tbl_bagian.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
					$this->db->where('tbl_bagian.id_user', "$id_user");
			}
			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get("tbl_bagian");

				if ($aksi == 't') {
					$p = "bagian_tambah";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Bagian | Aplikasi Manajemen Arsip";
				}elseif ($aksi == 'e') {
					$p = "bagian_edit";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
					$data['judul_web'] 	  = "Edit Bagian | Aplikasi Manajemen Arsip";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data bagian.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/bagian');
					// }

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_bagian", array('id_bagian' => "$id"))->row();
					$data['judul_web'] 	  = "Hapus Bagian | Aplikasi Manajemen Arsip";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data bagian.
					// 			</div>'
					// 		);
					// }else {
							$this->Mcrud->delete_bagian_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Bagian berhasil dihapus.
								</div>'
							);
					// }

					redirect('users/bagian');
				}else{
					$p = "bagian";

					$data['judul_web'] 	  = "Bagian | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pengaturan/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));

										$data = array(
											'nama_bagian'		=> $nama_bagian,
											'id_user'		    => $id_user
										);
										$this->Mcrud->save_bagian($data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Bagian berhasil ditambahkan.
											</div>'
										);

									redirect('users/bagian/t');
					}

					if (isset($_POST['btnupdate'])) {
							$nama_bagian   	 	= htmlentities(strip_tags($this->input->post('nama_bagian')));

									$data = array(
										'nama_bagian'	 => $nama_bagian
									);
									$this->Mcrud->update_bagian(array('id_bagian' => $id), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Bagian berhasil diupdate.
										</div>'
									);
									redirect('users/bagian');
					}

		}
	}

	public function klasifikasi($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			if ($data['user']->row()->level == 'user') {
					redirect('404_content');
			}

		//	$this->db->join('tbl_user', 'tbl_bagian.id_user=tbl_user.id_user');
		//	if ($data['user']->row()->level == 'user') {
		//			$this->db->where('tbl_bagian.id_user', "$id_user");
		//	}

			$this->db->order_by('tbl_klasifikasi.id_klasifikasi', 'ASC');
			$data['klasifikasi'] 		  = $this->db->get("tbl_klasifikasi");

				if ($aksi == 't') {
					$p = "klasifikasi_tambah";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Klasifikasi | Aplikasi Manajemen Arsip";
				}elseif ($aksi == 'e') {

					$p = "klasifikasi_edit";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_klasifikasi", array('id_klasifikasi' => "$id"))->row();
					$data['judul_web'] 	  = "Edit Klasifikasi | Aplikasi Manajemen Arsip";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data bagian.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/bagian');
					// }

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_klasifikasi", array('id_klasifikasi' => "$id"))->row();
					$data['judul_web'] 	  = "Hapus Klasifikasi | Aplikasi Manajemen Arsip";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data bagian.
					// 			</div>'
					// 		);
					// }else {
							$this->Mcrud->delete_klasifikasi_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Klasifikasi berhasil dihapus.
								</div>'
							);
					// }

					redirect('users/klasifikasi');

				}else{
					$p = "klasifikasi";

					$data['judul_web'] 	  = "Klasifikasi | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pengaturan/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$nama_klasifikasi   	 	= htmlentities(strip_tags($this->input->post('nama_klasifikasi')));

										$data = array(
											'nama_klasifikasi'	 => $nama_klasifikasi,
											
										);
										$this->Mcrud->save_klasifikasi($data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Klasifikasi berhasil ditambahkan.
											</div>'
										);

									redirect('users/klasifikasi/t');
					}

					if (isset($_POST['btnupdate'])) {
							$nama_klasifikasi   	 	= htmlentities(strip_tags($this->input->post('nama_klasifikasi')));

									$data = array(
										'nama_klasifikasi'	 => $nama_klasifikasi
									);
									$this->Mcrud->update_klasifikasi(array('id_klasifikasi' => $id), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Klasifikasi berhasil diupdate.
										</div>'
									);
									redirect('users/klasifikasi');
					}

		}
	}

	public function ns($aksi='', $id='')
	{
		redirect('404_content');
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			$this->db->where('tbl_bagian.id_user', "$id_user");
			$this->db->order_by('nama_bagian', 'ASC');
			$data['bagian']			  = $this->db->get("tbl_bagian")->result();

			if ($data['user']->row()->level == 'admin') {
					redirect('404_content');
			}

			// $this->db->join('tbl_bagian', 'tbl_bagian.id_bagian=tbl_ns.id_bagian');
			$this->db->order_by('tbl_ns.id_ns', 'DESC');
			$data['ns'] 		  = $this->db->get("tbl_ns");

				if ($aksi == 't') {
					$p = "ns_tambah";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Nomor Surat | Aplikasi Manajemen Arsip";
				}elseif ($aksi == 'e') {
					$p = "ns_edit";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_ns", array('id_ns' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Edit Nomor Surat | Aplikasi Manajemen Arsip";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data nomor surat.
								</div>'
							);

							redirect('users/ns');
					}

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_ns", array('id_ns' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Hapus Nomor Surat | Aplikasi Manajemen Arsip";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data nomor surat.
								</div>'
							);
					}else {
							$this->Mcrud->delete_ns_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Nomor surat berhasil dihapus.
								</div>'
							);
					}

					redirect('users/ns');
				}else{
					$p = "ns";

					$data['judul_web'] 	  = "Nomor surat | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pengaturan/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$separator 	 		= htmlentities(strip_tags($this->input->post('separator')));

						$no_posisi 	 		= htmlentities(strip_tags($this->input->post('no_posisi')));
						$no 	 					= htmlentities(strip_tags($this->input->post('no')));

						$org_posisi 		= htmlentities(strip_tags($this->input->post('org_posisi')));
						$org 	 					= htmlentities(strip_tags($this->input->post('org')));

						$bag_posisi 		= htmlentities(strip_tags($this->input->post('bag_posisi')));
						$bag 	 					= htmlentities(strip_tags($this->input->post('bag')));

						$subbag_posisi 	= htmlentities(strip_tags($this->input->post('subbag_posisi')));
						$subbag 	 			= htmlentities(strip_tags($this->input->post('subbag')));

						$bln_posisi 	 	= htmlentities(strip_tags($this->input->post('bln_posisi')));
						$bln 	 					= htmlentities(strip_tags($this->input->post('bln')));

						$thn_posisi 	 	= htmlentities(strip_tags($this->input->post('thn_posisi')));
						$thn 	 					= htmlentities(strip_tags($this->input->post('thn')));
						$reset_no 		 	= htmlentities(strip_tags($this->input->post('reset_no')));

						$prefix 	 			= htmlentities(strip_tags($this->input->post('prefix')));
						$prefix_posisi 	= htmlentities(strip_tags($this->input->post('prefix_posisi')));

						$jenis_ns 		 	= htmlentities(strip_tags($this->input->post('jenis_ns')));
						$ket 	 					= htmlentities(strip_tags($this->input->post('ket')));

						//1
						if ($no_posisi == 1) {
								$no1 = $no;
						}elseif ($no_posisi == 2) {
								$no2 = $no;
						}elseif ($no_posisi == 3) {
								$no3 = $no;
						}elseif ($no_posisi == 4) {
								$no4 = $no;
						}elseif ($no_posisi == 5) {
								$no5 = $no;
						}elseif ($no_posisi == 6) {
								$no6 = $no;
						}

						//2
						if ($org_posisi == 1) {
								$no1 = $org;
						}elseif ($org_posisi == 2) {
								$no2 = $org;
						}elseif ($org_posisi == 3) {
								$no3 = $org;
						}elseif ($org_posisi == 4) {
								$no4 = $org;
						}elseif ($org_posisi == 5) {
								$no5 = $org;
						}elseif ($org_posisi == 6) {
								$no6 = $org;
						}

						//3
						if ($bag_posisi == 1) {
								$no1 = $bag;
						}elseif ($bag_posisi == 2) {
								$no2 = $bag;
						}elseif ($bag_posisi == 3) {
								$no3 = $bag;
						}elseif ($bag_posisi == 4) {
								$no4 = $bag;
						}elseif ($bag_posisi == 5) {
								$no5 = $bag;
						}elseif ($bag_posisi == 6) {
								$no6 = $bag;
						}

						//4
						if ($subbag_posisi == 1) {
								$no1 = $subbag;
						}elseif ($subbag_posisi == 2) {
								$no2 = $subbag;
						}elseif ($subbag_posisi == 3) {
								$no3 = $subbag;
						}elseif ($subbag_posisi == 4) {
								$no4 = $subbag;
						}elseif ($subbag_posisi == 5) {
								$no5 = $subbag;
						}elseif ($subbag_posisi == 6) {
								$no6 = $subbag;
						}

						//5
						if ($bln_posisi == 1) {
								$no1 = $bln;
						}elseif ($bln_posisi == 2) {
								$no2 = $bln;
						}elseif ($bln_posisi == 3) {
								$no3 = $bln;
						}elseif ($bln_posisi == 4) {
								$no4 = $bln;
						}elseif ($bln_posisi == 5) {
								$no5 = $bln;
						}elseif ($bln_posisi == 6) {
								$no6 = $bln;
						}

						//6
						if ($thn_posisi == 1) {
								$no1 = $thn;
						}elseif ($thn_posisi == 2) {
								$no2 = $thn;
						}elseif ($thn_posisi == 3) {
								$no3 = $thn;
						}elseif ($thn_posisi == 4) {
								$no4 = $thn;
						}elseif ($thn_posisi == 5) {
								$no5 = $thn;
						}elseif ($thn_posisi == 6) {
								$no6 = $thn;
						}

						if ($no1 != '') {
								if ($no2 != '') {
										$no1 = "$no1$separator";
								}else{
										$no1 = "$no1";
								}
						}
						if ($no2 != '') {
								if ($no3 != '') {
										$no2 = "$no2$separator";
								}else{
										$no2 = "$no2";
								}
						}
						if ($no3 != '') {
								if ($no4 != '') {
										$no3 = "$no3$separator";
								}else{
										$no3 = "$no3";
								}
						}
						if ($no4 != '') {
								if ($no5 != '') {
										$no4 = "$no4$separator";
								}else{
										$no4 = "$no4";
								}
						}
						if ($no5 != '') {
								if ($no6 != '') {
										$no5 = "$no5$separator";
								}else{
										$no5 = "$no5";
								}
						}

						if ($prefix_posisi == "kiri") {
								$p_kiri  = "$prefix$separator";
								$p_kanan = '';
						}elseif ($prefix_posisi == "kanan") {
								$p_kiri  = '';
								$p_kanan = "$separator$prefix";
						}else{
								$p_kiri  = '';
								$p_kanan = '';
						}

						if ($reset_no == '') {
								$reset_no = 'thn';
						}

						$no_surat = "$p_kiri$no1$no2$no3$no4$no5$no6$p_kanan";

						if ($ket == '') {
								$ket = '-';
						}
										$data = array(
											'separator'			 => $separator,
											'no_posisi'			 => $no_posisi,
											'no'			  		 => $no,
											'org_posisi'		 => $org_posisi,
											'org'			  		 => $org,
											'bag_posisi'		 => $bag_posisi,
											'bag'						 => $bag,
											'subbag_posisi'	 => $subbag_posisi,
											'subbag'			   => $subbag,
											'bln_posisi'		 => $bln_posisi,
											'bln'			   		 => $bln,
											'thn_posisi'		 => $thn_posisi,
											'thn'		 				 => $thn,
											'reset_no'			 => $reset_no,
											'prefix'			   => $prefix,
											'prefix_posisi'	 => $prefix_posisi,
											'jenis_ns'			 => $jenis_ns,
											'ket'			   		 => $ket,
											'no_surat'			 => $no_surat,
											'id_user'			   => $id_user,
											'tgl_ns'				 => $tgl
										);
										$this->Mcrud->save_ns($data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Nomor Surat berhasil ditambahkan.
											</div>'
										);

									redirect('users/ns/t');
					}

					if (isset($_POST['btnupdate'])) {
						$separator 	 		= htmlentities(strip_tags($this->input->post('separator')));

						$no_posisi 	 		= htmlentities(strip_tags($this->input->post('no_posisi')));
						$no 	 					= htmlentities(strip_tags($this->input->post('no')));

						$org_posisi 		= htmlentities(strip_tags($this->input->post('org_posisi')));
						$org 	 					= htmlentities(strip_tags($this->input->post('org')));

						$bag_posisi 		= htmlentities(strip_tags($this->input->post('bag_posisi')));
						$bag 	 					= htmlentities(strip_tags($this->input->post('bag')));

						$subbag_posisi 	= htmlentities(strip_tags($this->input->post('subbag_posisi')));
						$subbag 	 			= htmlentities(strip_tags($this->input->post('subbag')));

						$bln_posisi 	 	= htmlentities(strip_tags($this->input->post('bln_posisi')));
						$bln 	 					= htmlentities(strip_tags($this->input->post('bln')));

						$thn_posisi 	 	= htmlentities(strip_tags($this->input->post('thn_posisi')));
						$thn 	 					= htmlentities(strip_tags($this->input->post('thn')));
						$reset_no 		 	= htmlentities(strip_tags($this->input->post('reset_no')));

						$prefix 	 			= htmlentities(strip_tags($this->input->post('prefix')));
						$prefix_posisi 	= htmlentities(strip_tags($this->input->post('prefix_posisi')));

						$jenis_ns 		 	= htmlentities(strip_tags($this->input->post('jenis_ns')));
						$ket 	 					= htmlentities(strip_tags($this->input->post('ket')));

						$no1 = '';
						$no2 = '';
						$no3 = '';
						$no4 = '';
						$no5 = '';
						$no6 = '';

						//1
						if ($no_posisi == 1) {
								$no1 = $no;
						}elseif ($no_posisi == 2) {
								$no2 = $no;
						}elseif ($no_posisi == 3) {
								$no3 = $no;
						}elseif ($no_posisi == 4) {
								$no4 = $no;
						}elseif ($no_posisi == 5) {
								$no5 = $no;
						}elseif ($no_posisi == 6) {
								$no6 = $no;
						}

						//2
						if ($org_posisi == 1) {
								$no1 = $org;
						}elseif ($org_posisi == 2) {
								$no2 = $org;
						}elseif ($org_posisi == 3) {
								$no3 = $org;
						}elseif ($org_posisi == 4) {
								$no4 = $org;
						}elseif ($org_posisi == 5) {
								$no5 = $org;
						}elseif ($org_posisi == 6) {
								$no6 = $org;
						}

						//3
						if ($bag_posisi == 1) {
								$no1 = $bag;
						}elseif ($bag_posisi == 2) {
								$no2 = $bag;
						}elseif ($bag_posisi == 3) {
								$no3 = $bag;
						}elseif ($bag_posisi == 4) {
								$no4 = $bag;
						}elseif ($bag_posisi == 5) {
								$no5 = $bag;
						}elseif ($bag_posisi == 6) {
								$no6 = $bag;
						}

						//4
						if ($subbag_posisi == 1) {
								$no1 = $subbag;
						}elseif ($subbag_posisi == 2) {
								$no2 = $subbag;
						}elseif ($subbag_posisi == 3) {
								$no3 = $subbag;
						}elseif ($subbag_posisi == 4) {
								$no4 = $subbag;
						}elseif ($subbag_posisi == 5) {
								$no5 = $subbag;
						}elseif ($subbag_posisi == 6) {
								$no6 = $subbag;
						}

						//5
						if ($bln_posisi == 1) {
								$no1 = $bln;
						}elseif ($bln_posisi == 2) {
								$no2 = $bln;
						}elseif ($bln_posisi == 3) {
								$no3 = $bln;
						}elseif ($bln_posisi == 4) {
								$no4 = $bln;
						}elseif ($bln_posisi == 5) {
								$no5 = $bln;
						}elseif ($bln_posisi == 6) {
								$no6 = $bln;
						}

						//6
						if ($thn_posisi == 1) {
								$no1 = $thn;
						}elseif ($thn_posisi == 2) {
								$no2 = $thn;
						}elseif ($thn_posisi == 3) {
								$no3 = $thn;
						}elseif ($thn_posisi == 4) {
								$no4 = $thn;
						}elseif ($thn_posisi == 5) {
								$no5 = $thn;
						}elseif ($thn_posisi == 6) {
								$no6 = $thn;
						}

						if ($no1 != '') {
								if ($no2 != '') {
										$no1 = "$no1$separator";
								}else{
										$no1 = "$no1";
								}
						}
						if ($no2 != '') {
								if ($no3 != '') {
										$no2 = "$no2$separator";
								}else{
										$no2 = "$no2";
								}
						}
						if ($no3 != '') {
								if ($no4 != '') {
										$no3 = "$no3$separator";
								}else{
										$no3 = "$no3";
								}
						}
						if ($no4 != '') {
								if ($no5 != '') {
										$no4 = "$no4$separator";
								}else{
										$no4 = "$no4";
								}
						}
						if ($no5 != '') {
								if ($no6 != '') {
										$no5 = "$no5$separator";
								}else{
										$no5 = "$no5";
								}
						}


						if ($prefix_posisi == "kiri") {
								$p_kiri  = "$prefix$separator";
								$p_kanan = '';
						}else{
								$p_kiri  = '';
								$p_kanan = "$separator$prefix";
						}

						if ($reset_no == '') {
								$reset_no = 'thn';
						}

						$no_surat = "$p_kiri$no1$no2$no3$no4$no5$no6$p_kanan";

						if ($ket == '') {
								$ket = '-';
						}
										$data = array(
											'separator'			 => $separator,
											'no_posisi'			 => $no_posisi,
											'no'			  		 => $no,
											'org_posisi'		 => $org_posisi,
											'org'			  		 => $org,
											'bag_posisi'		 => $bag_posisi,
											'bag'						 => $bag,
											'subbag_posisi'	 => $subbag_posisi,
											'subbag'			   => $subbag,
											'bln_posisi'		 => $bln_posisi,
											'bln'			   		 => $bln,
											'thn_posisi'		 => $thn_posisi,
											'thn'		 				 => $thn,
											'reset_no'			 => $reset_no,
											'prefix'			   => $prefix,
											'prefix_posisi'	 => $prefix_posisi,
											'jenis_ns'			 => $jenis_ns,
											'ket'			   		 => $ket,
											'no_surat'			 => $no_surat,
											'id_user'			   => $id_user
										);
									$this->Mcrud->update_ns(array('id_ns' => $id), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Nomor Surat berhasil diupdate.
										</div>'
									);
									redirect('users/ns');
					}

		}
	}


	public function sm($aksi='', $id='')
	{
		$ceknosm = $this->db->get_where('tbl_sm', array('no_surat' => $this->input->post('no_surat')));

		if ($ceknosm->num_rows() > 0) {
			$this->session->set_flashdata('gagal', " Maaf, nomor surat masuk sudah ada.");
			redirect('users/sm','refresh');
		}	

		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			// if ($data['user']->row()->level == 'admin') {
			// 		redirect('404_content');
			// }

			// $this->db->join('tbl_user', 'tbl_sm.id_user=tbl_user.id_user');
			// if ($data['user']->row()->level == 'user') {
			// 		$this->db->where('tbl_sm.id_user', "$id_user");
			// }

			$this->db->order_by('tbl_sm.id_sm', 'DESC');
			$data['sm'] 		  = $this->db->get("tbl_sm");

			$this->db->order_by('tbl_disposisi.id_disposisi', 'DESC');
			$data['ds'] 		  = $this->db->get("tbl_disposisi");

				if ($aksi == 't') {
					$p = "sm_tambah";
					if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Surat Masuk | Aplikasi Manajemen Arsip";
					
				}elseif ($aksi == 'd') {
					$p = "sm_detail";

					$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
					
					$data['judul_web'] 	  = "Detail Surat Masuk | Aplikasi Manajemen Arsip";

					
					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat masuk.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/sm');
					// }

					if ($data['user']->row()->level == 'user') {
							$data2 = array(
								'dibaca' => '1'
							);
							$this->Mcrud->update_sm(array('id_sm' => "$id"), $data2);
					}

					if (isset($_POST['btndisposisi'])) {
						$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
						$nama_bagian   	= htmlentities(strip_tags($this->input->post('nama_bagian')));
						$catatan   	 	= htmlentities(strip_tags($this->input->post('catatan')));
						$tgl_disposisi  = $this->input->post('tgl_disposisi');
						$no_urut	   	= htmlentities(strip_tags($this->input->post('no_urut')));
						$asal_surat	   	= htmlentities(strip_tags($this->input->post('asal_surat')));
						$tgl_surat	   	= $this->input->post('tgl_surat');
						$tgl_sm	   		= $this->input->post('tgl_sm');
						$no_agenda	   	= htmlentities(strip_tags($this->input->post('no_agenda')));
						$kepada	   		= htmlentities(strip_tags($this->input->post('kepada')));
						$perihal	   	= htmlentities(strip_tags($this->input->post('perihal')));

							$data = array(
								'no_surat'		 => $no_surat,
								'nama_bagian'	 => $nama_bagian,
								'catatan'		 => $catatan,
								'tgl_disposisi'	 => $tgl_disposisi,
								'no_urut'		 => $no_urut,
								'asal_surat'	 => $asal_surat,
								'tgl_sm'		 => $tgl_sm,
								'tgl_surat'		 => $tgl_surat,
								'no_agenda'		 => $no_agenda,
								'kepada'		 => $kepada,
								'perihal'		 => $perihal
							
							);

							$data2 = array(
								'disposisi' => '1'
							);

							$this->Mcrud->save_ds($data);

							$this->Mcrud->update_sm(array('no_surat' => $this->input->post('no_surat')), $data2);

							redirect('users/sm');
					}

					if (isset($_POST['btndisposisi0'])) {

							$data2 = array(
								'disposisi' => '0'
							);

							$data['query'] = $this->db->get_where("tbl_disposisi", array('no_surat' => $this->input->post('no_surat')))->row();

							$this->Mcrud->update_sm(array('no_surat' => $this->input->post('no_surat')), $data2);

							$this->db->where('no_surat', $this->input->post('no_surat'));
      						$this->db->delete('tbl_disposisi'); 

							redirect('users/sm');
					}

				}elseif ($aksi == 'e') {
					$p = "sm_edit";
					if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_sm", array('id_sm' => "$id"))->row();
					$data['judul_web'] 	  = "Edit Surat Masuk | Aplikasi Surat Menyurat";
					

					// if ($data['query']->id_user == '' or $data['query']->level != 'admin') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat masuk.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/sm');
					// }

				}elseif ($aksi == 'h') {
					$id=$this->uri->segment(4);
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$datacekuser= $this->db->get_where("tbl_sm inner join tbl_user on(tbl_user.id_user=tbl_sm.id_user)", array('tbl_sm.id_sm' => $id, 'tbl_sm.id_user' => $id_user))->row();
					
					$data['judul_web'] 	  = "Hapus Surat Masuk | Aplikasi Manajemen Arsip";

					if ($datacekuser->level != 'admin') {
							$this->session->set_flashdata('msg',
							 	'
							 	<div class="alert alert-warning alert-dismissible" role="alert">
							 		 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 			 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
							 		 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data surat masuk.
							</div>'
							);

					}else {

							$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $datacekuser->token_lampiran));
							foreach ($query_h->result() as $baris) {
								unlink('lampiran/'.$baris->nama_berkas);
							}

							$this->Mcrud->delete_lampiran($datacekuser->token_lampiran);
							$this->Mcrud->delete_sm_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat masuk berhasil dihapus.
								</div>'
							);
					}

					redirect('users/sm');
					

				}else{
					$p = "sm";

					$data['judul_web'] 	  = "Surat Masuk | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pemrosesan/$p", $data);
					$this->load->view('users/footer');

					if (isset($_POST['no_surat'])) {

						$this->upload->initialize(array(
							"upload_path"   => "./lampiran",
							"allowed_types" => "*" //jpg|jpeg|png|gif|bmp
						));

						if($this->upload->do_upload('userfile')){
							$no_surat   	 	= htmlentities(strip_tags($this->input->post('no_surat')));
							$tgl_surat   	 	= $this->input->post('tgl_surat',TRUE);
							$tgl_sm  	 		= $this->input->post('tgl_sm',TRUE);
							$asal_surat  	 	= htmlentities(strip_tags($this->input->post('asal_surat')));
							$no_agenda  		= htmlentities(strip_tags($this->input->post('no_agenda')));
							$klasifikasi 		= htmlentities(strip_tags($this->input->post('klasifikasi')));
							$penerima   	 	= htmlentities(strip_tags($this->input->post('penerima')));
							$kepada   	 		= htmlentities(strip_tags($this->input->post('kepada')));
							$perihal 	 		= htmlentities(strip_tags($this->input->post('perihal')));
							
							date_default_timezone_set('Asia/Jakarta');
							$waktu 	= date('Y-m-d H:m:s');
							$tgl 	= date('d-m-Y');

							$token = md5("$id_user-$waktu");

							$cek_status = $this->db->get_where('tbl_sm', "token_lampiran='$token'")->num_rows();
								if ($cek_status == 0) {
									$data = array(
										'no_surat'			 => $no_surat,
										'tgl_surat'		   	 => $tgl_surat,
										'tgl_sm'		   	 => $tgl_sm,
										'asal_surat'		 => $asal_surat,
										'no_agenda'	  		 => $no_agenda,
										'klasifikasi'	 	 => $klasifikasi,
										'penerima'	 		 => $penerima,
										'kepada'	 		 => $kepada,
										'perihal'		   	 => $perihal,
										'token_lampiran' 	 => $token,
										'id_user'			 => $id_user,
										'dibaca'			 => 0,
										'disposisi'			 => '',
										
									);
									$this->Mcrud->save_sm($data);
									$this->session->set_flashdata('sukses', "Surat masuk berhasil disimpan.");
        						redirect('users/sm','refresh');
									
								}

								$nama   = $this->upload->data('file_name');
								$ukuran = $this->upload->data('file_size');

								$this->db->insert('tbl_lampiran',array('nama_berkas'=>$nama,'ukuran'=>$ukuran,'token_lampiran'=>"$token"));

						}
							// $this->session->set_flashdata('msg',
							// 	'
							// 	<div class="alert alert-success alert-dismissible" role="alert">
							// 		 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							// 			 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							// 		 </button>
							// 		 <strong>Sukses!</strong> Surat Masuk berhasil ditambahkan.
							// 	</div>'
							// );
							//
							// redirect('users/sm');
					}

					if (isset($_POST['btnupdate'])) {
						$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
						$tgl_surat   	= $this->input->post('tgl_surat',TRUE);
						$tgl_sm  	 	= $this->input->post('tgl_sm',TRUE);
						$asal_surat  	= htmlentities(strip_tags($this->input->post('asal_surat')));
						$klasifikasi 	= htmlentities(strip_tags($this->input->post('klasifikasi')));
						$penerima   	= htmlentities(strip_tags($this->input->post('penerima')));
						$kepada   	 	= htmlentities(strip_tags($this->input->post('kepada')));
						$perihal 	 	= htmlentities(strip_tags($this->input->post('perihal')));
								
								$data = array(
									'no_surat'		   	 => $no_surat,
									'tgl_surat'		   	 => $tgl_surat,
									'tgl_sm'		   	 => $tgl_sm,
									'asal_surat'		 => $asal_surat,
									'klasifikasi'	 	 => $klasifikasi,
									'penerima'	 		 => $penerima,
									'kepada'	 		 => $kepada,
									'perihal'		   	 => $perihal,
									'id_user'			 => $id_user
									
								);
								$this->Mcrud->update_sm(array('id_sm' => $id), $data);
								$this->session->set_flashdata('sukses', "Surat masuk berhasil diupdate.");
        						redirect('users/sm','refresh');

									/*$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Surat Masuk berhasil diupdate.
										</div>'
									);
									redirect('users/sm');
									*/
					}

		}
	}

	public function sk($aksi='', $id='')
	{
		$ceknosk = $this->db->get_where('tbl_sk', array('no_surat' => $this->input->post('no_surat')));

		if ($ceknosk->num_rows() > 0) {
			$this->session->set_flashdata('gagal', " Maaf, nomor surat keluar sudah ada.");
			redirect('users/sk','refresh');
		}	

		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			// if ($data['user']->row()->level == 'admin') {
			// 		redirect('404_content');
			// }

			$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
					$this->db->where('tbl_sk.id_user', "$id_user");
			}
			$this->db->order_by('tbl_sk.id_sk', 'DESC');
			$data['sk'] 		  = $this->db->get("tbl_sk");

			$this->db->order_by('tbl_bagian.nama_bagian', 'ASC');
			$data['bagian'] 		  = $this->db->get_where("tbl_bagian","id_user='$id_user'")->result();

				if ($aksi == 't') {
					$p = "sk_tambah";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Surat Keluar | Aplikasi Manajemen Arsip";
					$data['data_ns']			= $this->Mcrud->data_ns('sk', "$id_user");
					
				}elseif ($aksi == 'd') {
					$p = "sk_detail";

					$this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
					$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id"))->row();
					$data['judul_web'] 	  = "Detail Surat Keluar | Aplikasi Manajemen Arsip";

					// if ($data['query']->id_user == '') {
					// 		$this->session->set_flashdata('msg',
					// 			'
					// 			<div class="alert alert-warning alert-dismissible" role="alert">
					// 				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					// 					 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
					// 				 </button>
					// 				 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat keluar.
					// 			</div>'
					// 		);
					//
					// 		redirect('users/sk');
					// }
					if ($data['user']->row()->level == 'admin') {
							$data2 = array(
								'dibaca' => '1'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);
					}

					if (isset($_POST['btndisposisi'])) {
							$data2 = array(
								'disposisi' => $_POST['bagian']
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}

					if (isset($_POST['btndisposisi0'])) {
							$data2 = array(
								'disposisi' => '0'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}

					if (isset($_POST['btnperingatan'])) {
							$data2 = array(
								'peringatan' => '1'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}

					if (isset($_POST['btnperingatan0'])) {
							$data2 = array(
								'peringatan' => '0'
							);
							$this->Mcrud->update_sk(array('id_sk' => "$id"), $data2);

							redirect('users/sk');
					}
				}elseif ($aksi == 'e') {
					$p = "sk_edit";
					if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'admin') {
							redirect('404_content');
					}

					// $this->db->join('tbl_user', 'tbl_sk.id_user=tbl_user.id_user');
					$data['query'] = $this->db->get_where("tbl_sk", array('id_sk' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Edit Surat Keluar | Aplikasi Manajemen Arsip";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data surat keluar.
								</div>'
							);

							redirect('users/sk');
					}

				}elseif ($aksi == 'h') {
					$id=$this->uri->segment(4);
					if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'admin') {
							redirect('404_content');
					}

					$datacek = $this->db->get_where("tbl_sk inner join tbl_user on(tbl_user.id_user=tbl_sk.id_user)", array('tbl_sk.id_sk' => $id, 'tbl_sk.id_user' => $id_user))->row();
					$data['judul_web'] 	  = "Hapus Surat Keluar | Aplikasi Manajemen Arsip";

					if ($datacek->level != 'user') {
							 $this->session->set_flashdata('msg',
							 	'
							 	<div class="alert alert-warning alert-dismissible" role="alert">
							 		 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							 			 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
							 		 </button>
							 		 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data surat keluar.
							 	</div>'
							 );
					}else {

							$query_h = $this->db->get_where("tbl_lampiran", array('token_lampiran' => $datacek->token_lampiran));
							foreach ($query_h->result() as $baris) {
								unlink('lampiran/'.$baris->nama_berkas);
							}

							$this->Mcrud->delete_lampiran($datacek->token_lampiran);
							$this->Mcrud->delete_sk_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat keluar berhasil dihapus.
								</div>'
							);
					}

					redirect('users/sk');
				}else{
					$p = "sk";

					$data['judul_web'] 	  = "Surat Keluar | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pemrosesan/$p", $data);
					$this->load->view('users/footer');

					if (isset($_POST['no_surat'])) {

						$this->upload->initialize(array(
							"upload_path"   => "./lampiran",
							"allowed_types" => "*" //jpg|jpeg|png|gif|bmp
						));

						if($this->upload->do_upload('userfile')){
							$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
							$tgl_sk   	 	= $this->input->post('tgl_sk',TRUE);
							$kepada   		= htmlentities(strip_tags($this->input->post('kepada')));
							$dari   		= htmlentities(strip_tags($this->input->post('dari')));
							$tembusan   	= htmlentities(strip_tags($this->input->post('tembusan')));
							$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));

							date_default_timezone_set('Asia/Jakarta');
							$waktu = date('Y-m-d H:m:s');
							$tgl 	 = date('d-m-Y');

							$token = md5("$id_user-$ns-$waktu");

							$cek_status = $this->db->get_where('tbl_sk', "token_lampiran='$token'")->num_rows();
								if ($cek_status == 0) {
									$data = array(
										'no_surat'			 => $no_surat,
										'tgl_sk'		   	 => $tgl_sk,
										'kepada'			 => $kepada,
										'dari'		 	 	 => $dari,
										'tembusan'		 	 => $tembusan,
										'perihal'		   	 => $perihal,
										'token_lampiran'	 => $token,
										'id_user'			 => $id_user,
										'dibaca'			 => 0,
										'peringatan'		 => '',
										
									);
									$this->Mcrud->save_sk($data);
									$this->session->set_flashdata('sukses', "Surat keluar berhasil disimpan.");
        						redirect('users/sk','refresh');
									
								}

								$nama   = $this->upload->data('file_name');
								$ukuran = $this->upload->data('file_size');

								$this->db->insert('tbl_lampiran',array('nama_berkas'=>$nama,'ukuran'=>$ukuran,'token_lampiran'=>"$token"));

						}
					}

					if (isset($_POST['btnupdate'])) {
						$no_surat   	= htmlentities(strip_tags($this->input->post('no_surat')));
						$tgl_sk   	 	= $this->input->post('tgl_sk',TRUE);
						$kepada   		= htmlentities(strip_tags($this->input->post('kepada')));
						$dari   		= htmlentities(strip_tags($this->input->post('dari')));
						$tembusan   	= htmlentities(strip_tags($this->input->post('tembusan')));
						$perihal   	 	= htmlentities(strip_tags($this->input->post('perihal')));

						$data = array(
								'no_surat'			 => $no_surat,
								'tgl_sk'		   	 => $tgl_sk,
								'kepada'			 => $kepada,
								'dari'		 	 	 => $dari,
								'tembusan'		 	 => $tembusan,
								'perihal'		   	 => $perihal
								
							);
						$this->Mcrud->update_sk(array('id_sk' => $this->input->post('id_sk',TRUE)), $data);
						$this->session->set_flashdata('sukses', "Surat keluar berhasil diupdate.");
        						redirect('users/sk','refresh');

							/*$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Surat Keluar berhasil diupdate.
								</div>'
							);
							redirect('users/sk');
							*/
					}

		}
	}

public function ds($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

			$this->db->order_by('tbl_disposisi.id_disposisi', 'DESC');
			$data['ds'] 		  = $this->db->get("tbl_disposisi");

			$this->db->order_by('tbl_sm.id_sm', 'DESC');
			$data['sm'] 		  = $this->db->get("tbl_sm");


				if ($aksi == 't') {
					$p = "ds_tambah";
					if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Disposisi | Aplikasi Manajemen Arsip";

				}elseif ($aksi == 'd') {
					$p = "ds_detail";

					$data['query'] = $this->db->get_where("tbl_disposisi", array('id_disposisi' => "$id"))->row();
					$data['judul_web'] 	  = "Detail Disposisi | Aplikasi Manajemen Arsip";

					if ($data['user']->row()->level == 'user') {
							$data2 = array(
								'dibaca' => '1'
							);
							
					}

					$data['query'] = $this->db->get_where("tbl_disposisi", array('id_disposisi' => "$id"))->row();
					$data['judul_web'] 	  = "Lembar Disposisi | Aplikasi Surat Menyurat";


				}elseif ($aksi == 'e') {
					$p = "ds_edit";
					if ($data['user']->row()->level == 's_admin' or $data['user']->row()->level == 'user') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_disposisi", array('id_disposisi' => "$id"))->row();
					$data['judul_web'] 	  = "Edit Disposisi | Aplikasi Surat Menyurat";

				
				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_disposisi", array('id_disposisi' => "$id"))->row();
					$data['judul_web'] 	  = "Hapus Disposisi | Aplikasi Manajemen Arsip";

							$this->Mcrud->delete_ds_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Disposisi berhasil dihapus.
								</div>'
							);


					redirect('users/ds');
				}else{
					$p = "ds";

					$data['judul_web'] 	  = "Disposisi | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/pemrosesan/$p", $data);
					$this->load->view('users/footer');


					if (isset($_POST['btnupdate'])) {
						$nama_bagian   	 = htmlentities(strip_tags($this->input->post('nama_bagian')));
						$tgl_disposisi	 = htmlentities(strip_tags($this->input->post('tgl_disposisi')));
						$catatan   		 = htmlentities(strip_tags($this->input->post('catatan')));
					
								$data = array(
									'nama_bagian'		   	 => $nama_bagian,
									'tgl_disposisi'		   	 => $tgl_disposisi,
									'catatan'				 => $catatan,
									
								);
								$this->Mcrud->update_ds(array('id_disposisi' => $id), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Disposisi berhasil diupdate.
										</div>'
									);
									redirect('users/ds');
					}

		}
	}

	public function memo($aksi='', $id='')
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		$id_user = $this->session->userdata('id_user@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			  = $this->Mcrud->get_users_by_un($ceks);

		//	if ($data['user']->row()->level == 'admin') {
		//			redirect('404_content');
		//	}

			$this->db->join('tbl_user', 'tbl_memo.id_user=tbl_user.id_user');
			if ($data['user']->row()->level == 'user') {
				$this->db->where('tbl_memo.id_user', "$id_user");
			}
			$this->db->order_by('tbl_memo.judul_memo', 'ASC');
			$data['memo'] 		  = $this->db->get("tbl_memo");

				if ($aksi == 't') {
					$p = "memo_tambah";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['judul_web'] 	  = "Tambah Memo | Aplikasi Manajemen Arsip";
				}elseif ($aksi == 'e') {
					$p = "memo_edit";
					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}

					$data['query'] = $this->db->get_where("tbl_memo", array('id_memo' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Edit Memo | Aplikasi Manajemen Arsip";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak mengubah data memo.
								</div>'
							);

							redirect('users/memo');
					}

				}elseif ($aksi == 'h') {

					if ($data['user']->row()->level == 's_admin') {
							redirect('404_content');
					}
					$data['query'] = $this->db->get_where("tbl_memo", array('id_memo' => "$id", 'id_user' => "$id_user"))->row();
					$data['judul_web'] 	  = "Hapus Memo | Aplikasi Manajemen Arsip";

					if ($data['query']->id_user == '') {
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-warning alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Gagal!</strong> Maaf, Anda tidak berhak menghapus data memo.
								</div>'
							);
					}else {
							$this->Mcrud->delete_memo_by_id($id);
							$this->session->set_flashdata('msg',
								'
								<div class="alert alert-success alert-dismissible" role="alert">
									 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
										 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
									 </button>
									 <strong>Sukses!</strong> Memo berhasil dihapus.
								</div>'
							);
					}

					redirect('users/memo');

				}else{
					$p = "memo";

					$data['judul_web'] 	  = "Memo | Aplikasi Manajemen Arsip";
				}

					$this->load->view('users/header', $data);
					$this->load->view("users/memo/$p", $data);
					$this->load->view('users/footer');

					date_default_timezone_set('Asia/Jakarta');
					$tgl = date('d-m-Y H:i:s');

					if (isset($_POST['btnsimpan'])) {
						$judul_memo   	 	= htmlentities(strip_tags($this->input->post('judul_memo')));
						$memo   	 				= htmlentities(strip_tags($this->input->post('memo')));

										$data = array(
											'judul_memo'	 => $judul_memo,
											'memo'				 => $memo,
											'id_user'		   => $id_user
										);
										$this->Mcrud->save_memo($data);

										$this->session->set_flashdata('msg',
											'
											<div class="alert alert-success alert-dismissible" role="alert">
												 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
													 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
												 </button>
												 <strong>Sukses!</strong> Memo berhasil ditambahkan.
											</div>'
										);

									redirect('users/memo/t');
					}

					if (isset($_POST['btnupdate'])) {
						$judul_memo   	 	= htmlentities(strip_tags($this->input->post('judul_memo')));
						$memo   	 				= htmlentities(strip_tags($this->input->post('memo')));

										$data = array(
											'judul_memo'	 => $judul_memo,
											'memo'				 => $memo,
											'id_user'		   => $id_user
										);
									$this->Mcrud->update_memo(array('id_memo' => $id), $data);

									$this->session->set_flashdata('msg',
										'
										<div class="alert alert-success alert-dismissible" role="alert">
											 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												 <span aria-hidden="true">&times;&nbsp; &nbsp;</span>
											 </button>
											 <strong>Sukses!</strong> Memo berhasil diupdate.
										</div>'
									);
									redirect('users/memo');
					}

		}
	}


	public function lap_sk()
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Laporan Surat Keluar | Aplikasi Manajemen Arsip";

					$this->load->view('users/header', $data);
					$this->load->view('users/laporan/lap_sk', $data);
					$this->load->view('users/footer');

					if (isset($_POST['data_lap'])) {
						$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
						$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

						redirect("users/data_sk/$tgl1/$tgl2");
					}
		}

	}


	public function data_sk()
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

				$tgl1=$this->input->get('tgl1');
				$tgl2=$this->input->get('tgl2');

						if ($tgl1 != '' AND $tgl2 != '') {
								$data['sql'] = $this->db->query("SELECT * FROM tbl_sk WHERE (tgl_sk BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sk DESC");

								$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
								$data['judul_web'] = "Data Laporan Surat Keluar | Aplikasi Manajemen Arsip";
								$this->load->view('users/header', $data);
								$this->load->view('users/laporan/data_sk', $data);
								$this->load->view('users/footer', $data);

								if (isset($_POST['btncetak'])) {
									redirect("users/cetak_sk/$tgl1/$tgl2");
								}

						}else{
								redirect('404_content');
						}

			}
	}


	public function cetak_sk($tgl1='',$tgl2='')
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

					if ($tgl1 != '' AND $tgl2 != '') {
							$data['sql'] = $this->db->query("SELECT * FROM tbl_sk WHERE (tgl_sk BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sk DESC");

							$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
							$data['judul_web'] = "Data Laporan Surat Keluar | Aplikasi Manajemen Arsip";

							$this->load->view('users/laporan/cetak_sk', $data);

					}else{
							redirect('404_content');
					}

			}
	}


	public function lap_sm()
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Laporan Surat Masuk | Aplikasi Manajemen Arsip";

					$this->load->view('users/header', $data);
					$this->load->view('users/laporan/lap_sm', $data);
					$this->load->view('users/footer');

					/*

					if (isset($_POST['data_lap'])) {
						$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
						$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

						redirect("users/data_sm/$tgl1/$tgl2");
					}
					*/
		}

	}

	public function data_sm()
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{
				$tgl1=$this->input->get('tgl1');
				$tgl2=$this->input->get('tgl2');

				$data['sql'] = $this->db->query("SELECT * FROM tbl_sm WHERE tgl_sm>='".$tgl1."' AND tgl_sm<='".$tgl2."' ORDER BY id_sm DESC");

				$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
				$data['judul_web'] = "Data Laporan Surat Masuk | Aplikasi Manajemen Arsip";
				$this->load->view('users/header', $data);
				$this->load->view('users/laporan/data_sm', $data);
				$this->load->view('users/footer', $data);

				if (isset($_POST['btncetak'])) {
					redirect("users/cetak_sm/$tgl1/$tgl2");
				}

			}
	}

	public function cetak_sm($tgl1='',$tgl2='')
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

					if ($tgl1 != '' AND $tgl2 != '') {
							$data['sql'] = $this->db->query("SELECT * FROM tbl_sm WHERE (tgl_sm BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_sm DESC");

							$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
							$data['judul_web'] = "Data Laporan Surat Masuk | Aplikasi Manajemen Arsip";

							$this->load->view('users/laporan/cetak_sm', $data);

					}else{
							redirect('404_content');
					}

			}
	}

	public function lap_ds()
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
		if(!isset($ceks)) {
			redirect('web/login');
		}else{
			$data['user']  			    = $this->Mcrud->get_users_by_un($ceks);
			$data['judul_web']			= "Laporan Surat Keluar | Aplikasi Manajemen Arsip";

					$this->load->view('users/header', $data);
					$this->load->view('users/laporan/lap_ds', $data);
					$this->load->view('users/footer');

					if (isset($_POST['data_lap'])) {
						$tgl1 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl1')))));
						$tgl2 	= date('d-m-Y', strtotime(htmlentities(strip_tags($this->input->post('tgl2')))));

						redirect("users/data_ds/$tgl1/$tgl2");
					}
		}

	}


	public function data_ds()
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{
				$tgl1=$this->input->get('tgl1');
				$tgl2=$this->input->get('tgl2');
						if ($tgl1 != '' AND $tgl2 != '') {
								$data['sql'] = $this->db->query("SELECT * FROM tbl_disposisi WHERE (tgl_disposisi BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_disposisi DESC");

								$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
								$data['judul_web'] = "Data Laporan Disposisi | Aplikasi Manajemen Arsip";
								$this->load->view('users/header', $data);
								$this->load->view('users/laporan/data_ds', $data);
								$this->load->view('users/footer', $data);

								if (isset($_POST['btncetak'])) {
									redirect("users/cetak_ds/$tgl1/$tgl2");
								}

						}else{
								redirect('404_content');
						}

			}
	}


	public function cetak_ds($tgl1='',$tgl2='')
	{
		$ceks 	 = $this->session->userdata('surat_menyurat@Proyek-2017');
			if(!isset($ceks)) {
				redirect('web/login');
			}else{

					if ($tgl1 != '' AND $tgl2 != '') {
							$data['sql'] = $this->db->query("SELECT * FROM tbl_disposisi WHERE (tgl_disposisi BETWEEN '$tgl1' AND '$tgl2') ORDER BY id_disposisi DESC");

							$data['user']  		 = $this->Mcrud->get_users_by_un($ceks);
							$data['judul_web'] = "Data Laporan Disposisi | Aplikasi Manajemen Arsip";

							$this->load->view('users/laporan/cetak_ds', $data);

					}else{
							redirect('404_content');
					}

			}
	}

	public function ds_cetak($id_ds)
	{
		$data['data'] = $this->db->get_where("tbl_disposisi", array('id_disposisi' => "$id_ds"))->row();

		$this->load->view('users/pemrosesan/ds_cetak', $data);

				
			}
	}


