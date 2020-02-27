        <p class="price"><span class="price1">価格</span><?php echo FudoUtil::kakaku( $post_id, 0, 1 ); ?></p>
        <ul class="detail-more">
        <li><span>所在地</span><?php echo FudoUtil::shozaichi( $post_id ); ?></li>
        <li><span>面積</span><?php echo FudoUtil::tochikukaku_menseki( $post_id ); ?><?php echo FudoUtil::keisoku_housiki( $post_id ); ?></li>
        <li><span>階数</span><?php echo FudoUtil::tatemonokaisuu( $post_id ); ?></li>
        <li><span>間取り</span><?php echo FudoUtil::madori( $post_id ); ?></li>
        <li><span>築年</span><?php echo FudoUtil::chikunenn( $post_id ); ?></li>
        <li><span>取引</span><?php echo FudoUtil::torihikitaiyo( $post_id ); ?></li>
        <li><span>交通</span><?php echo FudoUtil::koutus_all_view( $post_id ); ?></li>
        </ul>