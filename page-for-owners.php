<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="content-area for_owners" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><?php wp_title(''); ?></li>
	</ul>

	<div class="column-wrap">
		<h2>INFORMATION FOR OWNERS<span>オーナー様へ</span></h2>

		<section class="wrap-block">
			<h3>FOR OWNERS<span>オーナー様へ</span></h3>
			<div class="wrap-inner">
				<strong>オーナー様にとって、アパートは重要な財産です。</strong>
				<p class="tex">最初の10年は新しいので、入居者の確保も比較的簡単ですが、10年以上経つと本格的な企業努力が必要になってきます。<br>
				例えばクロスの張替えや、外周の補修等、アパートの維持に必要な事柄が色々と出てきます。新築の時と同じ家賃では入居者の確保も難しくなってくるかもしれません。<br>
				しかし、家賃を下げるということは、オーナー様の財産の価値が下がるということではないでしょうか。家賃を一部屋当り5,000円下げるなら、古くなった浴槽を新しい物にする、部屋の壁を塗り直す、など設備投資に掛けて頂くという方法も一つだと思います。そうすれば、財産の価値をなるべく下げずに運営も可能なのではないでしょうか。<br>
				私共はこのようなご提案も含め、オーナー様と入居者の方々とのスムーズな関係が築かれるよう、クレーム対応等の日常業務はもちろん、月毎に建物や駐車場の清掃を行い、報告書の提出、入金管理、等を行ないたいと考えております。<br>
				従来の不動産仲介業ではなく、オーナー様の側に立った管理業を目指しております。 「入居者の確保だけが私共の仕事ではない」という信念に基づいて、オーナー様の満足頂ける管理体制を作り上げて行きたいと思っております。 私共不動産業者はこれまで「仲介料を受け取れば仕事は終わり」という形態を採ってきました。<br>
				しかし私共はそこから一歩踏み出し、これからはオーナー様に御満足いただける仕事をして、管理料を頂くわけです。オーナー様から管理料を頂く事により、これまで私共が受け取ってきた仲介料を、他の不動産業者と分け合うことなく、全額を他業者に渡すことにより、情報公開の幅が広がり、また、他業者の力の入れ方にも違いが出てくることにより、新規入居者の獲得率が格段に高くなるのは云うまでもないことだと思います。新規入居者を獲得できれば、アパートの空室を減らす事ができます。<br>
				オーナー様にとっても家賃が全室分入るのは、これほど嬉しい事は無いのではないでしょうか。そこで、管理システムのご提案をさせて頂きます。<br>
				感謝・・・・</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3>SYSTEM<span>管理体制</span></h3>
			<div class="wrap-inner">
				<p class="tex">
				<img src="<?php echo get_template_directory_uri(); ?>/images/for_owners/fig1.png">
				</p>
				<br>

				<strong>賃貸管理業務内容</strong>
				<p class="tex">
					<strong>■入居者管理</strong>
					入所審査、保証人への確認など
					<strong>■家賃管理</strong>
					当社に入金後、オーナー様のご指定の口座に毎月15日までご入金いたします。また、詳しい明細書を発行します。
					<strong>■保証会社による保証システムの利用</strong>
					保証料を支払うことにより、引き落とし不能だった場合には、保証会社より入居者様へ直接督促し最長6ヶ月まで建て替え可能です。
					<strong>■建物管理業務</strong>
					定期的な月１回の共有部分の清掃、階段部分の掃き掃除、蜘蛛の巣取り、駐車場のごみ拾い、敷地・駐車場の草取りなどを行います。
					<strong>■入金・要望・クレーム対応</strong>
					入居者間のトラブル（騒音など）や周辺住民苦情（ごみ出しなど）がおこった場合には対応致します。
					<strong>■退去時の立ち合い点検</strong>
					現場復帰工事の手配（ハウスクリーニング・畳・障子の張り替えなどの業者手配）、敷金の精算
					<strong>■入居者家財保険</strong>
					保険加入の手続きをします。火災、盗難、水漏れ事故などに対応致します。2年ごとの更新手続きとなります。
					<strong>■その他</strong>
					・リフォームのご提案（現在の賃貸市場に適し、入居者のニーズにあった設備のご提案） ・空き部屋の管理 ・空き部屋の鍵の保管、管理

				</p>
			</div>
		</section>

	</div>
	

</div><!-- .content-area -->

<?php get_footer(); ?>
