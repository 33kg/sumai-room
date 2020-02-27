        <ul class="detail-more">
        <li><span>所在地</span><?php echo FudoUtil::shozaichi( $post_id ); ?></li>
        <li><span>敷金</span><?php echo FudoUtil::shikikin( $post_id ); ?></li>
        <li><span>礼金</span><?php echo FudoUtil::reikin( $post_id ); ?></li>
        <li><span>築年</span><?php echo FudoUtil::chikunenn( $post_id ); ?></li>
        <li><span>階数</span><?php echo FudoUtil::heyakaisuu( $post_id ); ?>/<?php echo FudoUtil::tatemonokaisuu( $post_id ); ?></li>
        <li><span>駐車場</span><?php echo FudoUtil::tyuusyajo_kubun( $post_id ); ?></li>
        <li><span>構造</span><?php echo FudoUtil::tatemonokouzou( $post_id ); ?></li>
        <li><span>間取り</span><?php echo FudoUtil::madori( $post_id ); ?></li>
        </ul>