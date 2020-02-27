        <ul class="detail-more2">
        <?php
        //利回り計算
        $kakaku_hyourimawari = get_post_meta( $post_id, 'kakakuhyorimawari', true );
        $kakaku_rimawari = get_post_meta($post_id, 'kakakurimawari', true);
        ?>

		<li><span>築年</span><?php echo FudoUtil::kyoueki_kannrihi( $post_id ); ?></li>
        <li><span>敷地面積</span><?php echo FudoUtil::tatemonozentaimenseki( $post_id ); ?></li>
		<li><span>用途地域</span><?php echo FudoUtil::syuzen_tumitatekin( $post_id ); ?></li>
		<li><span>都市計画</span><?php echo FudoUtil::kanrininn( $post_id ); ?></li>
		<li><span>引き渡し</span><?php echo FudoUtil::hikiwatasi_jiki( $post_id ); ?></li>
		<li><span>借地区分</span><?php echo FudoUtil::tyuusyajo_kubun( $post_id ); ?></li>
		<li><span>借地年月</span><?php echo FudoUtil::tyuusyajo_ryoukin( $post_id ); ?></li>
        <li><span>接道1</span><?php echo FudoUtil::setudou1( $post_id ); ?></li>
        <li><span>接道2</span><?php echo FudoUtil::setudou2( $post_id ); ?></li>
        <li><span>周辺環境</span><?php echo FudoUtil::syuuhen_kankyou( $post_id ); ?></li>
        <li><span>表面利回り</span><?php if($kakaku_hyourimawari){ echo $kakaku_hyourimawari . '%'; } ?></li>
        <li><span>現行利回り</span><?php if($kakaku_rimawari){ echo $kakaku_rimawari . '%'; } ?></li>
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