<ul class="detail-more2">
		<li><span>国土法届出</span><?php echo FudoUtil::kokudohoutodokede( $post_id ); ?></li>
		<li><span>地目</span><?php echo FudoUtil::chimoku( $post_id ); ?></li>
		<li><span>地勢</span><?php echo FudoUtil::chisei( $post_id ); ?></li>
		<li><span>都市計画</span><?php echo FudoUtil::tochikeikaku( $post_id ); ?></li>
		<li><span>セットバック</span><?php echo FudoUtil::setback( $post_id ); ?></li>
		<li><span>引渡時期</span><?php echo FudoUtil::hikiwatasi_jiki( $post_id ); ?></li>
		<li><span>接道状況</span><?php echo FudoUtil::setudou_joukyou( $post_id ); ?></li>
		<li><span>借地料</span><?php echo FudoUtil::syougakkou( $post_id ); ?></li>
		<li><span>借地年月日</span><?php echo FudoUtil::syakuti_keiyaku_nengetu( $post_id ); ?></li>
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