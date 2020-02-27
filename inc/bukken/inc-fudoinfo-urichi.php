        <p class="price"><span class="price1">価格</span><?php echo FudoUtil::kakaku( $post_id, 0, 1 ); ?></p>
        <ul class="detail-more">
        <li><span>所在地</span><?php echo FudoUtil::shozaichi( $post_id ); ?></li>
        <li><span>面積</span><?php echo FudoUtil::tochikukaku_menseki( $post_id ); ?><?php echo FudoUtil::keisoku_housiki( $post_id ); ?></li>
        <li><span>用途</span><?php echo FudoUtil::youtochiiki( $post_id ); ?></li>
        <li><span>権利</span><?php echo FudoUtil::tochikenri( $post_id ); ?></li>
        <li><span>建蔽率</span><?php echo FudoUtil::kenpeiritu( $post_id ); ?></li>
        <li><span>容積率</span><?php echo FudoUtil::yousekiritu( $post_id ); ?></li>
        <li><span>交通</span><?php echo FudoUtil::koutus_all_view( $post_id ); ?></li>
        </ul>