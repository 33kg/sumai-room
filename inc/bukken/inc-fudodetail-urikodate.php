        <ul class="detail-more2">
        <li><span>土地面積</span><?php echo FudoUtil::tochikukaku_menseki( $post_id ); ?></li>
		<li><span>土地権利</span><?php echo FudoUtil::tochikenri( $post_id ); ?></li>
		<li><span>現況</span><?php echo FudoUtil::genkyou( $post_id ); ?></li>
		<li><span>引き渡し</span><?php echo FudoUtil::hikiwatasi_jiki( $post_id ); ?></li>
		<li><span>セットバック</span><?php echo FudoUtil::setback( $post_id ); ?></li>
		<li><span>接面道路</span><?php echo FudoUtil::tochishido( $post_id ); ?></li>
		<li><span>間取り内訳</span><?php echo FudoUtil::madori_utiwake( $post_id ); ?></li>
		<li><span>周辺環境</span><?php echo FudoUtil::syuuhen_kankyou( $post_id ); ?></li>
		</ul>
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