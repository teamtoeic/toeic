<div id="sidebar">
	<ul id="main-nav">
	  <li><a href="#" class="nav-top-item no-submenu">Thông báo</a> 
	  	<ul>
	  		<?php
	  			foreach ($thong_baos as $tb) {
	  				?> 
	  				<li><a href="javascript:void(0)" onclick="Doc_thong_bao(<?php echo $tb['ma_thong_bao']?>)"><?php echo $tb['tieu_de']?></a></li>
	  				<?php
	  			}
	  		?>
	  	</ul>
	  </li>
	</ul>
</div>