        <ul class="detail-more2">
        <li><span>向き</span><?php echo FudoUtil::muki( $post_id ); ?></li>
		<li><span>共益・管理費</span><?php echo FudoUtil::kyoueki_kannrihi( $post_id ); ?></li>
		<li><span>修繕積立金</span><?php echo FudoUtil::syuzen_tumitatekin( $post_id ); ?></li>
		<li><span>管理人</span><?php echo FudoUtil::kanrininn( $post_id ); ?></li>
		<li><span>管理形態</span><?php echo FudoUtil::kanrikeitai( $post_id ); ?></li>
		<li><span>現況</span><?php echo FudoUtil::genkyou( $post_id ); ?></li>
		<li><span>引き渡し</span><?php echo FudoUtil::hikiwatasi_jiki( $post_id ); ?></li>
		<li><span>駐車場区分</span><?php echo FudoUtil::tyuusyajo_kubun( $post_id ); ?></li>
		<li><span>駐車料金</span><?php echo FudoUtil::tyuusyajo_ryoukin( $post_id ); ?></li>
        <li><span>駐車場備考</span><?php echo FudoUtil::tyuusyajo_bikou( $post_id ); ?></li>
        <li><span>間取り内訳</span><?php echo FudoUtil::madori_utiwake( $post_id ); ?></li>
		</ul>

		<dl class="detail-more3">
        <dt>設備・条件</dt>
		<dd>
			<ul class="icon-property2">
            <?php
                $setsubi_datas = FudoUtil::get_syuuhen_setubi( $post_id );
                foreach( $setsubi_datas as $setsubi ):
            ?>
            <li><?php echo $setsubi; ?></li>
            <?php endforeach; ?>
			</ul>

		</dd>
		</dl>