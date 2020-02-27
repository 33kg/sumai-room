        <ul class="detail-more2">
		<li><span>向き</span><?php echo FudoUtil::muki( $post_id ); ?></li>
		<li><span>現状</span><?php echo FudoUtil::genkyou( $post_id ); ?></li>
		<li><span>住宅保険料</span><?php echo FudoUtil::juutakuhokenryoukikan( $post_id ); ?></li>
		<li><span>更新料</span><?php echo FudoUtil::koushinryou( $post_id ); ?></li>
		<li><span>引き渡し</span><?php echo FudoUtil::hikiwatasi_jiki( $post_id ); ?></li>
		<li><span>面積</span><?php echo FudoUtil::menseki( $post_id ); ?></li>
		<li><span>駐車場区分</span><?php echo FudoUtil::tyuusyajo_kubun( $post_id ); ?></li>
		<li><span>駐車料金</span><?php echo FudoUtil::tyuusyajo_ryoukin( $post_id ); ?></li>
		<li><span>小学校</span><?php echo FudoUtil::syougakkou( $post_id ); ?></li>
		<li><span>中学校</span><?php echo FudoUtil::tyuugakkou( $post_id ); ?></li>
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