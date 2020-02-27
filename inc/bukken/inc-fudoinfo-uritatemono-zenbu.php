        
        <ul class="detail-more">
        <li><span>所在地</span><?php echo FudoUtil::shozaichi( $post_id ); ?></li>
        <li><span>面積</span><?php echo FudoUtil::tochikukaku_menseki( $post_id ); ?><?php echo FudoUtil::keisoku_housiki( $post_id ); ?></li>
        <li><span>階数</span><?php echo FudoUtil::tatemonokaisuu( $post_id ); ?></li>
        <li><span>間取り</span><?php echo FudoUtil::madori( $post_id ); ?></li>
        <li><span>構造</span><?php echo FudoUtil::tatemonokouzou( $post_id ); ?></li>
        <li><span>取引</span><?php echo FudoUtil::torihikitaiyo( $post_id ); ?></li>
        <li><span>交通</span><?php echo FudoUtil::koutus_all_view( $post_id ); ?></li>
        </ul>