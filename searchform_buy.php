<?php
/**
 * 検索フォーム
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' )."fudo/" ); ?>" class="jsearch">
<input type="hidden" name="bukken" value="jsearch" >
<input type="hidden" name="shub" value="<?php echo $shub?>" >
		<dl>
		<dt>物件種別</dt>
		<dd>
			<ul class="list2">
			<?php $i = 0; ?>
			<?php foreach( $bukkenSyubetuHash as $key => $value ): ?>
			<li><input type="checkbox" name="shu[]" value="<?php echo $key; ?>" id="<?php echo $key; ?>"><label for="<?php echo $key; ?>"><?php echo $value; ?></label></li>
			<?php endforeach; ?>
			</ul>
		</dd>
		<dt>地域</dt>
		<dd>
			<ul class="list2">
			<?php foreach($shikuHash as $fudoName => $hash):?>
				<?php foreach($hash as $key => $value):?>
					<li><input type="checkbox" name="ksik[]"  value="<?php echo $key?>" id="<?php echo $key?>"><label for="<?php echo $key; ?>"><?php echo $value?></label></li>
				<?php endforeach?>
			<?php endforeach?>
			</ul>
		</dd>
		<dt>価格</dt>
		<dd>
			<ul class="list">
			<li>
				<select name="kalb" id="kalb">
				<?php foreach($kakakuLowHash as $key => $value):?>
					<option value="<?php echo $key?>"><?php echo $value?></option>
					<?php endforeach?>
				</select>
		  	</li>
			<li>
				〜
		  	</li>
			<li>
				<select name="kahb" id="kahb">
				<?php foreach($kakakuHighHash as $key => $value):?>
					<?php $selected = !$key ? 'selected':'0';?>
					<option value="<?php echo $key?>" <?php echo $selected?>><?php echo $value?></option>
					<?php endforeach?>
	          	</select>
		  	</li>
			</ul>
		</dd>
		<dt>面積</dt>
		<dd>
			<ul class="list">
			<li>
				<select name="mel" id="mel">
				<?php foreach($mensekiLowHash as $key => $value):?>
				<option value="<?php echo $key?>"><?php echo $value?></option>
				<?php endforeach?>
	          	</select>
		  	</li>
			<li>
				〜
		  	</li>
			<li>
				<select name="meh" id="meh">
					<?php foreach($mensekiHighHash as $key => $value):?>
					<?php $selected = !$key ? 'selected':'0';?>
						<option value="<?php echo $key?>" <?php echo $selected?>><?php echo $value?></option>
					<?php endforeach?>
	          	</select>
		  	</li>
			</ul>
		</dd>
		<dt>築年数</dt>
		<dd>
			<ul class="list">
			<li>
				<select name="tik" id="tik">
				<?php foreach($tikunensuuHash as $key => $value):?>
				<option value="<?php echo $key?>"><?php echo $value?></option>
				<?php endforeach?>
				</select>
		  	</li>
			</ul>
		</dd>
		<dt>間取り</dt>
		<dd>
			<ul class="list">
			<?php foreach ( $madoriHash as $key => $value ):?>
				<li><input name="mad[]" value="<?php echo $key; ?>" id="mad2<?php echo $key; ?>" type="checkbox"/><label for="mad2<?php echo $key; ?>"><?php echo $value; ?></label></li>
			<?php endforeach?>
			</ul>
		</dd>
<?php /*/ ?>
		<dt>条件</dt>
		<dd>
			<ul class="list3">
			<?php foreach ( $setubiHash as $key => $value ):?>
				<li><input type="checkbox" name="set[]"  value="<?php echo $key; ?>" id="set2<?php echo $key; ?>"><label for="set2<?php echo $key; ?>"><?php echo $value; ?></label></li>
			<?php endforeach?>
		
			</ul>
		</dd>
<?php /*/ ?>
		</dl>
	<button type="submit" class="search-submit"><span class="screen-reader-text">上記の条件で検索</span></button>
</form>
