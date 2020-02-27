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

<div class="content-area about_concierge" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><?php wp_title(''); ?></li>
	</ul>

	<div class="column-wrap">
		<h2>ABOUT CONCIERGE<span>不動産コンシェルジュとは</span></h2>
		<section class="wrap-block">
			<h3 class="title-topics">ただ不動産を紹介するだけではない<br>不動産を通じてお客様を幸せにする、それが不動産コンシェルジュです</h3>
			<p class="tex">全てのお客様に納得して不動産を選んでもらいたい。 そのために住まいるーむ情報館では自らを「不動産コンシェルジュ」とし、<br>
				ただ不動産の仲介をするのではなく、不動産を通じてお客様を幸せにすることを使命にしています。<br>
				お客様のご要望に寄り添い、少しでも不安や問題を解決できるよう、常に学び続けます。</p>
			<ul class="step">
			<li><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/about_concierge_step1.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/about_concierge_step2.png"></li>
			<li><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/about_concierge_step3.png"></li>
			</ul>
		</section>
		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08818.png"></p>
			<div class="wrap-tex">
				<p class="name">志田 宏
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>志田さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">不動産業者でありながら、相続に関するトラブル、諸問題を一緒になって考えられます。学びに対して貪欲であること。</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>宅地建物取引主任者、二級建築士、上級相続診断士、住宅ローンアドバイザー</dd>
				<dt>出身</dt>
				<dd>寒河江市</dd>
				<dt>担当</dt>
				<dd>業務全般</dd>
				<dt>学び</dt>
				<dd>相続に関すること、投資に関すること、コンサルティングに関すること、論語</dd>
				<dt>趣味</dt>
				<dd>山登り、筋トレ</dd>
				</dl>
			</div>
		</section>

		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08876.png"></p>
			<div class="wrap-tex">
				<p class="name">志田 裕美
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>志田さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">長年培ってきた経験と知識を生かして、お客様のご要望にあったお部屋選びのお手伝いをさせて頂きます。</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>宅地建物取引士</dd>
				<dt>出身</dt>
				<dd>山形市</dd>
				<dt>担当</dt>
				<dd>総務、賃貸営業</dd>
				<dt>学び</dt>
				<dd>住空間収納プランナーの資格取得のため日々勉強しています。</dd>
				<dt>趣味</dt>
				<dd>雑貨屋さん巡り</dd>
				</dl>
			</div>
		</section>

		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08888.png"></p>
			<div class="wrap-tex">
				<p class="name">渡辺 郁恵
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>渡辺さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">これまでの知識と経験を活かし、お客様へわかりやすい説明を心がけています。お客様の不安に寄り添い、「不動産の相談は住まいるーむ情報館へ」と言っていただけるよう、日々学んでいます。</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>宅地建物取引士、賃貸不動産管理士、相続相談士、不動産キャリアパーソン</dd>
				<dt>出身</dt>
				<dd>寒河江市</dd>
				<dt>担当</dt>
				<dd>賃貸営業、売買営業</dd>
				<dt>学び</dt>
				<dd>ファイナンシャルプランナーの資格取得を目指し日々勉強しています。</dd>
				<dt>趣味</dt>
				<dd>温泉巡り</dd>
				</dl>
			</div>
		</section>

		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08847.png"></p>
			<div class="wrap-tex">
				<p class="name">佐藤 夏美
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>佐藤さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">不動産会社という初めての方も多く、少し緊張なさるかもしれませんが、お客様とお話させて頂く中で楽しんで物件を探して頂けるよう、頑張ります。</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>不動産キャリアパーソン</dd>
				<dt>出身</dt>
				<dd>山形市</dd>
				<dt>担当</dt>
				<dd>賃貸営業・賃貸物件管理</dd>
				<dt>学び</dt>
				<dd>お客様のお役に立てるようインテリアコーディネーターも目指します</dd>
				<dt>趣味</dt>
				<dd>只今子育て奮闘中にて落ち着いたらやりたい趣味・・・DIY</dd>
				</dl>
			</div>
		</section>

		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08741.png"></p>
			<div class="wrap-tex">
				<p class="name">武田 悦至
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>武田さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">取り扱っている商品、物件など丁寧に扱っています。自分自身も商品の一部という思いで丁寧な接客を心掛けています。</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>宅地建物取引士、大型運転免許、簿記３級</dd>
				<dt>出身</dt>
				<dd>山形市</dd>
				<dt>担当</dt>
				<dd>材木業務</dd>
				<dt>学び</dt>
				<dd>日々勉強です。人に怒られたり、褒められたりなど色々な方のおかげで成長しています。</dd>
				<dt>趣味</dt>
				<dd>ゴルフ始めました</dd>
				</dl>
			</div>
		</section>

		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08909.png"></p>
			<div class="wrap-tex">
				<p class="name">志田 雄亮
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>志田さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">賃貸物件を借りる方は色々な不安があるかと思います。そんな不安を一つでも多く解消し、住まいるーむ情報館で一番の若さを生かして、フットワーク軽く皆様の知りたい情報をいち早く集めお届けいたします！</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>普通免許</dd>
				<dt>出身</dt>
				<dd>寒河江市</dd>
				<dt>担当</dt>
				<dd>賃貸営業</dd>
				<dt>学び</dt>
				<dd>宅地建物取引士の資格取得の為の勉強中です。</dd>
				<dt>趣味</dt>
				<dd>海外ドラマ鑑賞</dd>
				</dl>
			</div>
		</section>

		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08761.png"></p>
			<div class="wrap-tex">
				<p class="name">阿部 光雄
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>阿部さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">「亀の甲より年の功」たくさんの経験から物件管理のスペシャリストを目指しています。清掃はもちろん、草刈、小修繕などお任せください。若いころに鍛えた腕で管理物件のメンテナンスに全力投球します。</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>リフト、玉掛け、クレーン</dd>
				<dt>出身</dt>
				<dd>西川町</dd>
				<dt>担当</dt>
				<dd>管理物件清掃業務</dd>
				</dl>
			</div>
		</section>

		<section class="wrap-block auther">
			<p class="img"><img src="<?php echo get_template_directory_uri(); ?>/images/about_concierge/DSC08781.png"></p>
			<div class="wrap-tex">
				<p class="name">佐竹 亜希
					<a class="to-list" href="<?php echo esc_url( home_url( '/' ) ); ?>concierge"><span>佐竹さん発信の</span>情報をみる<strong>≫</strong></a>
				</p>
				<p class="tex">入居中は気持ち良くお住まいただけるよう、ご入居検討の方には良い印象を持っていただけるようにとの想いを込めて管理物件の清掃を担当しています。女性ならではの細やかな視線でお客様の満足をつくります。</p>
				<dl class="spec">
				<dt>資格</dt>
				<dd>普通免許</dd>
				<dt>出身</dt>
				<dd>東根市</dd>
				<dt>担当</dt>
				<dd>管理物件清掃業務</dd>
				</dl>
			</div>
		</section>

	</div>
	

</div><!-- .content-area -->

<?php get_footer(); ?>
