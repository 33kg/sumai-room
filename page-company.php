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

<div class="content-area company" style="min-height:800px;">

	<ul class="breadlist">
	<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">住まいるーむ情報館</a></li>
	<li><?php wp_title(''); ?></li>
	</ul>

	<div class="column-wrap">
		<h2>COMPANY PROFILE<span>会社概要</span></h2>
		<section class="wrap-block">
			<h3>PROFILE<span>会社概要</span></h3>
			<div class="wrap-inner">
				<table>
				<tr>
				<th>商号</th>
				<td>有限会社　住まいるーむ情報館</td>
				</tr>
				<tr>
				<th>所在地</th>
				<td>本　店　山形県寒河江市大字寒河江字横道137<br>
					山形店　山形県山形市鈴川町三丁目1-22</td>
				</tr>
				<tr>
				<th>設立</th>
				<td>昭和53年（平成16年法人化）</td>
				</tr>
				<tr>
				<th>資本金</th>
				<td>900万円</td>
				</tr>
				<tr>
				<th>代表取締役</th>
				<td>志田　宏</td>
				</tr>
				<tr>
				<th>電話番号</th>
				<td>本　店　0237-86-6396<br>
					山形店　023-615-8077</td>
				</tr>
				<tr>
				<th>FAX番号</th>
				<td>本　店　0237-86-6390<br>
					山形店　023-615-8078</td>
				</tr>
				<tr>
				<th>MAIL</th>
				<td>info@sumai-room.com</td>
				</tr>
				<tr>
				<th>免許番号</th>
				<td>山形県知事免許（４）第2212号</td>
				</tr>
				<tr>
				<th>所属団体</th>
				<td>東北地区不動産公正取引協議会加盟<br>
					（公社）山形県宅地建物取引業協会会員</td>
				</tr>
				</table>
			</div>
		</section>
		<section class="wrap-block">
			<h3 class="double">COMPANY <br>PHIROSOPHY<span>経営哲学</span></h3>
			<div class="wrap-inner">
				<p class="tex">創業は志田宏文によって寒河江市六供町の自宅、所持金3万円からスタートでした。<br>
				<br>
				宏文は西川町大井沢の田舎育ち、その日暮らしの貧しい家庭でした。<br>
				中学卒業後、「炭焼き」の仕事をしながら、冬になれば関東に出稼ぎで家族を支えたのです。<br>
				<br>
				昭和53年 「身内や世の中に迷惑を掛けない」「どんな小さな仕事でもいいから家族が笑って暮らせれば良い」との決意を持ち、より良い住まいのお役に立ちたいとの念いで木材業を創業。「質素・倹約」に重きをおいて経営を貫き、今も語り継がれる言葉「いい格好するな」を何度も何度も言い続けました。<br>
				つまり「質実剛健」であり創業者の哲学でした。<br>
				貧しくても笑顔で暮らす事を夢見ながら、その日その日を頑張り抜いたのです。<br>
				<br>
				平成16年「住環境を通して人々を笑顔にしたい」そんな想いで木材業から不動産業へ。 <br>
				創業者の精神も引き継ぎながら「不動産業界の矛盾や慣習を変える」という強い信念のもと会社を進化させていったのです。<br>
				住まいはあくまで「人が幸せになるため」の手段の一つ。<br>
				お客様の暮らしをおもい、たくさんの感謝と笑顔の種を蒔くために・・・<br>
				その精神から「有限会社　住まいるーむ情報館」が生まれたのです。 これが創業の想いであり、素直な気持ちです。</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3>VISION<span>経営ビジョン</span></h3>
			<div class="wrap-inner">
				<strong>私たちは不動産で人を幸せにします。</strong>
				<p class="tex">商いを通し、世の為人々の為に役に立つ人間となり全社員が幸せになることが使命です。<br>
				・商いとは人と人とのふれあい。価値の交換 ・世の為、人々の為は「利」のみを追求するのではなく「義」を重んじる事<br>
				・役に立つは必要とされる会社、人財となること<br>
				・「幸」は形に見えないもの。心に豊かさを持ち自分自身の成長があること<br>
				・「福」は努力して得るもの。全従業員に経済面での安心を与えます。</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3 class="double">Management <br>philosophy<span>経営理念</span></h3>
			<div class="wrap-inner">
				<strong>私達は住環境の領域で「感謝」と「笑顔」の種を蒔き<br>幸福（こうふく）の花を咲かせます。</strong>
				<p class="tex">私達は「感謝と笑顔の種を蒔く」これが仕事です。そのために人間力を上げる必要があり学び続ける必要があります。人間力無くして私達は仕事出来ません。<br>
				そして我々は一生の財産である不動産、住まいに関する事に真面目に一生懸命取り組む事で、お客様から信用が得られ世の中の役に立ちます。 種を蒔くのは外！結果的に花を咲かせてお客様が幸せになる。つまり自分達も幸せになるのです。</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3 class="double">SALES <br>philosophy<span>営業理念</span></h3>
			<div class="wrap-inner">
				<strong>私たちはお困りごとを笑顔に変えます。</strong>
				<p class="tex">・賃貸管理のクレーム改善<br>
					・相続問題の不安の解消<br>
					・FPにてお金の不安の解消<br>
					・空き家管理をクラウドにて動画で報告</p>
			</div>
		</section>
		<section class="wrap-block">
			<h3 class="double">Educational <br>philosophy<span>教育理念</span></h3>
			<div class="wrap-inner">
				<strong>①向上心を忘れず日々学ぶ<br>
					②お客様の幸福のために日々成長する<br>
					③家庭に喜びを作るために日々笑顔を忘れない<br>
					④地域社会に貢献するために日々誠実に生きる</strong>
				<p class="tex">・賃貸管理のクレーム改善<br>
					・相続問題の不安の解消<br>
					・FPにてお金の不安の解消<br>
					・空き家管理をクラウドにて動画で報告</p>
			</div>
		</section>

		<section class="wrap-block">
			<h3>STORES<span>店舗情報</span></h3>
			<div class="wrap-inner">
				<strong>有限会社 住まいるーむ情報館　本店</strong>
				<p class="tex">〒991-0041　山形県寒河江市大字寒河江横道137<br>
					TEL: 0237-86-6396<br>
					FAX: 0237-86-6390<br>
					MAIL: info@sumai-room.com<br>
					【営業時間】9：30～18：30<br>
					【定休日】毎週水曜日(年末年始・お盆はお休みあり）</p>
				<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d6256.415388225102!2d140.2806388!3d38.3673165!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x5f8bc6abe7856617%3A0x13c7af56ce6f97f8!2z77yI5pyJ77yJ5L2P44G-44GE44KL44O844KA5oOF5aCx6aSo!5e0!3m2!1sja!2sjp!4v1551350286712" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe></div>
				<p class="tex"><strong>【事業内容】</strong></p>
				<p class="tex"><strong>1.不動産売買仲介</strong>
					土地・中古一戸建てを中心に、幅広く紹介活動を行っております。ご縁を何よりも大切にし、お客様一人ひとりに合った物件をご一緒にお探しいたします。		
				<strong>2.不動産賃貸仲介</strong>
					地域No.1を目指し、当社物件に留まらず各不動産業者と協力のもと、アパート・テナント・駐車場など寒河江市内のあらゆる情報をご用意しています。
				<strong>3.賃貸物件管理</strong>
					管理物件においては、賃貸部と連携し、物件の点検・清掃活動はもちろん、毎月の家賃も当社で管理しています。 また、空家管理サービスとして空家管理業務も行っています。
				<strong>4.住宅資材</strong>
					創業は材木業者ということもあり、長年培ってきた信頼と実績で安定した仕入れルートにより材木、建材を主にハウスメーカー様、地域ビルダー様、工務店様向けに販売しております。</p>
				<br>
				<br>

				<strong>有限会社 住まいるーむ情報館　山形店</strong>
				<p class="tex">〒990-0062<br>
					山形県山形市鈴川町3丁目1-22<br>
					TEL: 023-615-8077<br>
					FAX: 023-615-8078<br>
					MAIL: info@sumai-room.com<br>
					【営業時間】9：30～18：30<br>
					【定休日】毎週水曜日(年末年始・お盆はお休みあり）</p>
				<div class="map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d783.1051594303631!2d140.35542282919207!3d38.269741051635805!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzjCsDE2JzExLjEiTiAxNDDCsDIxJzIxLjUiRQ!5e0!3m2!1sja!2sjp!4v1567671498904!5m2!1sja!2sjp" width="100%" height="350" frameborder="0" style="border:0;" allowfullscreen=""></iframe></div>	
				<p class="tex"><strong>【事業内容】</strong></p>
				<p class="tex"><strong>1.不動産相続の相続窓口</strong>
					不動産に関する相続の問題を事前に解決し、不動産の有効活用をお手伝いを行います。		
				<strong>2.不動産売買仲介</strong>
					土地・中古一戸建てを中心に、幅広く紹介活動を行っております。具体的に住宅ローンのシミュレーションを行い、将来を見据えた資金計画をご提案致します。
				<strong>3.空き家管理</strong>
					点検、管理をリーズナブルな価格で行うプランから月２回巡回プランまで３種類のプランをご用意しております。お客様にあったプランをお選びいただけます。点検報告は動画レポートでWeb上で手軽にいつでもご確認頂けます。</p>
			</div>
		</section>

	</div>
	

</div><!-- .content-area -->

<?php get_footer(); ?>
