<?php
/**
 * 検索フォーム
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

		<dl>
		<dt>物件種別</dt>
		<dd>
			<ul class="list2">
			<li><input id="box_a1" type="checkbox" /><label for="box_a1">売地</label></li>
			<li><input id="box_a2" type="checkbox" /><label for="box_a2">新築戸建て</label></li>
			<li><input id="box_a3" type="checkbox" /><label for="box_a3">中古戸建て</label></li>
			<li><input id="box_a4" type="checkbox" /><label for="box_a4">収益物件</label></li>
			<li><input id="box_a5" type="checkbox" /><label for="box_a5">その他</label></li>
			</ul>
		</dd>
		<dt>地域</dt>
		<dd>
			<ul class="list2">
			<li><input id="box_b1" type="checkbox" /><label for="box_b1">山形市</label></li>
			<li><input id="box_b2" type="checkbox" /><label for="box_b2">寒河江市</label></li>
			<li><input id="box_b3" type="checkbox" /><label for="box_b3">天童市</label></li>
			<li><input id="box_b4" type="checkbox" /><label for="box_b4">朝日町</label></li>
			<li><input id="box_b5" type="checkbox" /><label for="box_b5">朝日町</label></li>
			<li><input id="box_b6" type="checkbox" /><label for="box_b6">大江町</label></li>
			</ul>
		</dd>
		<dt>賃料</dt>
		<dd>
			<ul class="list">
			<li>
				<select name="kalb" id="kalb">
				<option value="0">下限なし</option>
				<option value="500">500万円</option>
				<option value="1000">1000万円</option>
				<option value="1500">1500万円</option>
				<option value="2000">2000万円</option>
				<option value="2500">2500万円</option>
				<option value="3000">3000万円</option>
				<option value="3500">3500万円</option>
				<option value="4000">4000万円</option>
				<option value="4500">4500万円</option>
				<option value="5000">5000万円</option>
				<option value="5500">5500万円</option>
				<option value="6000">6000万円</option>
				<option value="7000">7000万円</option>
				<option value="8000">8000万円</option>
				<option value="9000">9000万円</option>
				<option value="10000">1億円</option>
				</select>
		  	</li>
			<li>
				〜
		  	</li>
			<li>
				<select name="kahb" id="kahb">
				<option value="500" >500万円</option>
				<option value="1000" >1000万円</option>
				<option value="1500" >1500万円</option>
				<option value="2000" >2000万円</option>
				<option value="2500" >2500万円</option>
				<option value="3000" >3000万円</option>
				<option value="3500" >3500万円</option>
				<option value="4000" >4000万円</option>
				<option value="4500" >4500万円</option>
				<option value="5000" >5000万円</option>
				<option value="5500" >5500万円</option>
				<option value="6000" >6000万円</option>
				<option value="7000" >7000万円</option>
				<option value="8000" >8000万円</option>
				<option value="9000" >9000万円</option>
				<option value="10000" >1億円</option>
				<option value="0" selected>上限なし</option>
				</select>
		  	</li>
			</ul>
		</dd>
		<dt>面積</dt>
		<dd>
			<ul class="list">
			<li>
				<select name="mel" id="mel">
				<option value="0">下限なし</option>
				<option value="10">10m&sup2;</option>
				<option value="15">15m&sup2;</option>
				<option value="20">20m&sup2;</option>
				<option value="25">25m&sup2;</option>
				<option value="30">30m&sup2;</option>
				<option value="35">35m&sup2;</option>
				<option value="40">40m&sup2;</option>
				<option value="50">50m&sup2;</option>
				<option value="60">60m&sup2;</option>
				<option value="70">70m&sup2;</option>
				<option value="80">80m&sup2;</option>
				<option value="90">90m&sup2;</option>
				<option value="100">100m&sup2;</option>
				<option value="120">120m&sup2;</option>
				<option value="140">140m&sup2;</option>
				<option value="160">160m&sup2;</option>
				<option value="180">180m&sup2;</option>
				<option value="200">200m&sup2;</option>
				<option value="300">300m&sup2;</option>
				<option value="400">400m&sup2;</option>
				<option value="500">500m&sup2;</option>
				<option value="600">600m&sup2;</option>
				<option value="700">700m&sup2;</option>
				<option value="800">800m&sup2;</option>
				<option value="900">900m&sup2;</option>
				<option value="1000">1000m&sup2;</option>
				</select>
		  	</li>
			<li>
				〜
		  	</li>
			<li>
				<select name="meh" id="meh">
				<option value="10" >10m&sup2;</option>
				<option value="15" >15m&sup2;</option>
				<option value="20" >20m&sup2;</option>
				<option value="25" >25m&sup2;</option>
				<option value="30" >30m&sup2;</option>
				<option value="35" >35m&sup2;</option>
				<option value="40" >40m&sup2;</option>
				<option value="50" >50m&sup2;</option>
				<option value="60" >60m&sup2;</option>
				<option value="70" >70m&sup2;</option>
				<option value="80" >80m&sup2;</option>
				<option value="90" >90m&sup2;</option>
				<option value="100" >100m&sup2;</option>
				<option value="120" >120m&sup2;</option>
				<option value="140" >140m&sup2;</option>
				<option value="160" >160m&sup2;</option>
				<option value="180" >180m&sup2;</option>
				<option value="200" >200m&sup2;</option>
				<option value="300" >300m&sup2;</option>
				<option value="400" >400m&sup2;</option>
				<option value="500" >500m&sup2;</option>
				<option value="600" >600m&sup2;</option>
				<option value="700" >700m&sup2;</option>
				<option value="800" >800m&sup2;</option>
				<option value="900" >900m&sup2;</option>
				<option value="1000" >1000m&sup2;</option>
				<option value="0" selected>上限なし</option>
				</select>
		  	</li>
			</ul>
		</dd>
		</dl>
	<button type="submit" class="search-submit"><span class="screen-reader-text">上記の条件で検索</span></button>
</form>
