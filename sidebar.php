<?php
require_once "config/init.php";
$pg = isset($_GET['pg']) ? $_GET['pg'] : "";
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="asset/dist/img/user-icon.jpg" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>Administrator</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li <?= checkMenu("dashboard", $pg); ?>>
				<a href="?pg=dashboard">
					<i class="fa fa-th"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="treeview <?= checkParentMenu($pg); ?>">
				<a href="#">
					<i class="fa fa-tags"></i> 
					<span>Data Master</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li <?= checkMenu("master_barang_jadi", $pg); ?>><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Master Barang Jadi</span></a></li>
					<li <?= checkMenu("master_barang_pokok", $pg); ?>><a href="?pg=master_barang_pokok"><i class="fa fa-circle-o fa-fw"></i> <span>Master Barang Pokok</span></a></li>
					<li <?= checkMenu("master_lokasi", $pg); ?>><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Master Lokasi</span></a></li>
					<li <?= checkMenu("master_konveksi", $pg); ?>><a href="?pg=master_konveksi"><i class="fa fa-circle-o fa-fw"></i> <span>Master Konveksi</span></a></li>
					<li <?= checkMenu("master_akun", $pg); ?>><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Master Akun</span></a></li>
					<li <?= checkMenu("master_supplier", $pg); ?>><a href="?pg=master_supplier"><i class="fa fa-circle-o fa-fw"></i> <span>Master Supplier</span></a></li>
					<li <?= checkMenu("master_customer", $pg); ?>><a href="?pg=master_customer"><i class="fa fa-circle-o fa-fw"></i> <span>Master Customer</span></a></li>
					<li <?= checkMenu("master_admin", $pg); ?>><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Master Admin</span></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-shopping-basket"></i> 
					<span>Transaksi Pembelian</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Pembelian <small>[Barang Pokok]</small></span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Return Pembelian</span></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-cube"></i> <span>Form Barang</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Barang Pokok Masuk</span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Barang Pokok Keluar </span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Barang Jadi Masuk </span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Barang Jadi Keluar </span></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-arrow-right"></i> 
					<span>Transfer Stok</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Gudang ke Toko</span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Toko ke Gudang</span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Toko ke Toko</span></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-shopping-cart"></i> 
					<span>Transaksi Penjualan</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Penjualan</span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Return Penjualan</span></a></li>
				</ul>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i> 
					<span>Stok Opname</span>
					<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
				</a>
				<ul class="treeview-menu">
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Stok Opname Toko</span></a></li>
					<li><a href="#"><i class="fa fa-circle-o fa-fw"></i> <span>Stok Opname Gudang</span></a></li>
				</ul>
			</li>
			<li>
				<a href="#">
					<i class="fa fa-calendar"></i> <span>Kas Harian</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>