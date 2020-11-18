<?php date_default_timezone_set('Asia/Jakarta');
 if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
	class Jariprom_tools {
		
		function acakPassword($pass){
			$str = "!@#$%JARIPROM<>?LK";
			$pass_fix = md5($pass.md5($str));
			return $pass_fix;
		}
		
		function base64_encode_fix($string){
			$base_64_string = base64_encode($string);
			$url_param = rtrim($base_64_string, '=');
		    return $url_param;
		}
		
		function formatPmb($angka,$jumlah){
			$jumlah_nol = strlen($angka);
			$angka_nol = $jumlah - $jumlah_nol;
			$nol = "";
			for($i=1;$i<=$angka_nol;$i++){
				$nol .= '0';
			}
			return $nol.$angka;
		}
		
		function tglIndo($tanggal){
			$bulan = array (
				1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
			$pecahkan = explode('-', $tanggal);
			return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
		}
		
		function penyebut($nilai) {
			$nilai = abs($nilai);
			$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
			$temp = "";
			if ($nilai < 12) {
				$temp = " ". $huruf[$nilai];
			} else if ($nilai <20) {
				$temp = $this->penyebut($nilai - 10). " belas";
			} else if ($nilai < 100) {
				$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
			} else if ($nilai < 200) {
				$temp = " seratus" . $this->penyebut($nilai - 100);
			} else if ($nilai < 1000) {
				$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
			} else if ($nilai < 2000) {
				$temp = " seribu" . $this->penyebut($nilai - 1000);
			} else if ($nilai < 1000000) {
				$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
			} else if ($nilai < 1000000000) {
				$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
			} else if ($nilai < 1000000000000) {
				$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
			} else if ($nilai < 1000000000000000) {
				$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
			}     
			return $temp;
		}
	 
		function terbilang($nilai) {
			if($nilai<0) {
				$hasil = "minus ". trim($this->penyebut($nilai));
			} else {
				$hasil = trim($this->penyebut($nilai));
			}     		
			return $hasil;
		}

		function base64_decode_fix($string){
			$base_64_string = $string . str_repeat('=', strlen($string) % 4);
		    return base64_decode($base_64_string);
		}
		
		function tglWktSekarang(){
			$tanggal = date("Y-m-d H:i:s");
			return $tanggal;
		}
		
		function wktSekarang(){
			$tanggal = date("H:i:s");
			return $tanggal;
		}
		
		function tglSekarang(){
			$tanggal = date("Y-m-d");
			return $tanggal;
		}
		
		function fungsiRp($nomimal){
			$angka = $nomimal;
			$jumlah_desimal = 0;
			$pemisah_desimal = ",";
			$pemisah_ribuan = ".";
			return "Rp ".number_format($angka, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan).",-";
		}
	}