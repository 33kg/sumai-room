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
			<li><input id="box_a1" type="checkbox" /><label for="box_a1">マンション</label></li>
			<li><input id="box_a2" type="checkbox" /><label for="box_a2">アパート</label></li>
			<li><input id="box_a3" type="checkbox" /><label for="box_a3">一戸建</label></li>
			<li><input id="box_a4" type="checkbox" /><label for="box_a4">店舗</label></li>
			<li><input id="box_a5" type="checkbox" /><label for="box_a5">事務所</label></li>
			</ul>
		</dd>
		<dt>地域</dt>
		<dd>
			<ul class="list2">
			<li><input id="box_b1" type="checkbox" /><label for="box_b1">寒河江市</label></li>
			<li><input id="box_b2" type="checkbox" /><label for="box_b2">鶴岡市</label></li>
			<li><input id="box_b3" type="checkbox" /><label for="box_b3">東根市</label></li>
			<li><input id="box_b4" type="checkbox" /><label for="box_b4">河北町</label></li>
			</ul>
		</dd>
		<dt>賃料</dt>
		<dd>
			<ul class="list">
			<li>
				<select name="kalc" id="kalc">
				<option value="0">下限なし</option>
				<option value="3">3万円</option>
				<option value="4">4万円</option>
				<option value="5">5万円</option>
				<option value="6">6万円</option>
				<option value="7">7万円</option>
				<option value="8">8万円</option>
				<option value="9">9万円</option>
				<option value="10">10万円</option>
	          	</select>
		  	</li>
			<li>
				〜
		  	</li>
			<li>
				<select name="kahc" id="kahc">
				<option value="3" >3万円</option>
				<option value="4" >4万円</option>
				<option value="5" >5万円</option>
				<option value="6" >6万円</option>
				<option value="7" >7万円</option>
				<option value="8" >8万円</option>
				<option value="9" >9万円</option>
				<option value="10" >10万円</option>
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
		<dt>築年数</dt>
		<dd>
			<ul class="list">
			<li>
				<select name="tik" id="tik">
				<option value="0">指定なし</option>
				<option value="1">1年以内(新築)</option>
				<option value="3">3年以内</option>
				<option value="5">5年以内</option>
				<option value="10">10年以内</option>
				<option value="15">15年以内</option>
				<option value="20">20年以内</option>
				</select>
		  	</li>
			</ul>
		</dd>
		<dt>間取り</dt>
		<dd>
			<ul class="list">
			<li><input name="mad[]" value="110" id="mad2110" type="checkbox"/><label for="mad2110">1R</label></li>
			<li><input name="mad[]" value="120" id="mad2120" type="checkbox"/><label for="mad2120">1K</label></li>
			<li><input name="mad[]" value="150" id="mad2150" type="checkbox"/><label for="mad2150">1LDK</label></li>
			<li><input name="mad[]" value="220" id="mad2220" type="checkbox"/><label for="mad2220">2K</label></li>
			<li><input name="mad[]" value="230" id="mad2230" type="checkbox"/><label for="mad2230">2DK</label></li>
			<li><input name="mad[]" value="250" id="mad2250" type="checkbox"/><label for="mad2250">2LDK</label></li>
			<li><input name="mad[]" value="320" id="mad2320" type="checkbox"/><label for="mad2320">3K</label></li>
			<li><input name="mad[]" value="330" id="mad2330" type="checkbox"/><label for="mad2330">3DK</label></li>
			<li><input name="mad[]" value="350" id="mad2350" type="checkbox"/><label for="mad2350">3LDK</label></li>
			</ul>
		</dd>
		<dt>条件</dt>
		<dd>
			<ul class="list3">
			<li><input type="checkbox" name="set[]"  value="10101" id="set210101"><label for="set210101">事務所可</label></li>
			<li><input type="checkbox" name="set[]"  value="10902" id="set210902"><label for="set210902">ペット可能</label></li>
			<li><input type="checkbox" name="set[]"  value="25001" id="set225001"><label for="set225001">敷金礼金0</label></li>
			<li><input type="checkbox" name="set[]"  value="23601" id="set223601"><label for="set223601">角部屋</label></li>
			<li><input type="checkbox" name="set[]"  value="25002" id="set225002"><label for="set225002">未入居</label></li>
			<li><input type="checkbox" name="set[]"  value="20701" id="set220701"><label for="set220701">ガスコンロ</label></li>
			<li><input type="checkbox" name="set[]"  value="20703" id="set220703"><label for="set220703">IHコンロ</label></li>
			<li><input type="checkbox" name="set[]"  value="20901" id="set220901"><label for="set220901">システムキッチン</label></li>
			<li><input type="checkbox" name="set[]"  value="24501" id="set224501"><label for="set224501">カウンターキッチン</label></li>
			<li><input type="checkbox" name="set[]"  value="21001" id="set221001"><label for="set221001">給湯</label></li>
			<li><input type="checkbox" name="set[]"  value="21101" id="set221101"><label for="set221101">追い焚き</label></li>
			<li><input type="checkbox" name="set[]"  value="21201" id="set221201"><label for="set221201">洗髪洗面化粧台</label></li>
			<li><input type="checkbox" name="set[]"  value="25701" id="set225701"><label for="set225701">独立洗面台</label></li>
			<li><input type="checkbox" name="set[]"  value="20301" id="set220301"><label for="set220301">バス専用</label></li>
			<li><input type="checkbox" name="set[]"  value="20601" id="set220601"><label for="set220601">シャワー</label></li>
			<li><input type="checkbox" name="set[]"  value="24601" id="set224601"><label for="set224601">浴室乾燥機</label></li>
			<li><input type="checkbox" name="set[]"  value="26006" id="set226006"><label for="set226006">ユニットバス</label></li>
			<li><input type="checkbox" name="set[]"  value="20401" id="set220401"><label for="set220401">トイレ専用</label></li>
			<li><input type="checkbox" name="set[]"  value="20501" id="set220501"><label for="set220501">バス・トイレ別</label></li>
			<li><input type="checkbox" name="set[]"  value="24201" id="set224201"><label for="set224201">温水洗浄便座</label></li>
			<li><input type="checkbox" name="set[]"  value="21304" id="set221304"><label for="set221304">エアコン</label></li>
			<li><input type="checkbox" name="set[]"  value="21601" id="set221601"><label for="set221601">W.INクローゼット</label></li>
			<li><input type="checkbox" name="set[]"  value="21701" id="set221701"><label for="set221701">ロフト付き</label></li>
			<li><input type="checkbox" name="set[]"  value="21801" id="set221801"><label for="set221801">室内洗濯機置き場</label></li>
			<li><input type="checkbox" name="set[]"  value="22101" id="set222101"><label for="set222101">BSアンテナ</label></li>
			<li><input type="checkbox" name="set[]"  value="26003" id="set226003"><label for="set226003">地デジ対応</label></li>
			<li><input type="checkbox" name="set[]"  value="26301" id="set226301"><label for="set226301">インターネット無料</label></li>
			<li><input type="checkbox" name="set[]"  value="22301" id="set222301"><label for="set222301">オートロック</label></li>
			<li><input type="checkbox" name="set[]"  value="23801" id="set223801"><label for="set223801">TVドアホン</label></li>
			<li><input type="checkbox" name="set[]"  value="20101" id="set220101"><label for="set220101">都市ガス</label></li>
			<li><input type="checkbox" name="set[]"  value="20102" id="set220102"><label for="set220102">プロパンガス</label></li>
			<li><input type="checkbox" name="set[]"  value="20001" id="set220001"><label for="set220001">公営水道</label></li>
			<li><input type="checkbox" name="set[]"  value="20201" id="set220201"><label for="set220201">排水下水</label></li>
			<li><input type="checkbox" name="set[]"  value="20202" id="set220202"><label for="set220202">排水浄化槽</label></li>
			<li><input type="checkbox" name="set[]"  value="20203" id="set220203"><label for="set220203">排水汲取</label></li>
			<li><input type="checkbox" name="set[]"  value="22401" id="set222401"><label for="set222401">エレベータ</label></li>
			<li><input type="checkbox" name="set[]"  value="25005" id="set225005"><label for="set225005">駐車場有</label></li>
			<li><input type="checkbox" name="set[]"  value="23101" id="set223101"><label for="set223101">駐輪場</label></li>
			<li><input type="checkbox" name="set[]"  value="22701" id="set222701"><label for="set222701">バルコニー</label></li>
			<li><input type="checkbox" name="set[]"  value="22801" id="set222801"><label for="set222801">フローリング</label></li>
			<li><input type="checkbox" name="set[]"  value="24401" id="set224401"><label for="set224401">オール電化</label></li>
			<li><input type="checkbox" name="set[]"  value="25601" id="set225601"><label for="set225601">家具・家電付</label></li>
			</ul>
		</dd>
		</dl>
	<button type="submit" class="search-submit"><span class="screen-reader-text">上記の条件で検索</span></button>
</form>
