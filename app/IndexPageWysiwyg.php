<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\IndexPageWysiwyg
 *
 * @property int $id
 * @property string $image_up_first_text
 * @property string $image_up_second_text
 * @property string $image_up_third_text
 * @property string $image_up_fourth_text
 * @property string $section_one_header
 * @property string $section_one_first_up_text
 * @property string $section_one_first_bootom_text
 * @property string $section_one_second_up_text
 * @property string $section_one_second_down_text
 * @property string $section_one_third_up_text
 * @property string $section_one_third_down_text
 * @property string $section_one_fourth_up_text
 * @property string $section_one_fourth_down_text
 * @property string $section_one_fifth_up_text
 * @property string $section_one_fifth_down_text
 * @property string $image_1
 * @property string $image_2
 * @property string $section_three_heading
 * @property string $section_three_image1
 * @property string $section_three_image2
 * @property string $section_three_image3
 * @property string $section_three_image4
 * @property string $section_three_image5
 * @property string $section_three_image6
 * @property string $section_three_image7
 * @property string $section_three_image8
 * @property string $section_three_image9
 * @property string $section_three_image10
 * @property string $section_three_image11
 * @property string $section_three_image12
 * @property string $section_three_image13
 * @property string $section_three_image14
 * @property string $section_three_image15
 * @property string $section_three_image16
 * @property string $section_four_heading_upper
 * @property string $section_four_heading_bottom
 * @property string $section_four_first_text
 * @property string $section_four_second_text
 * @property string $section_four_third_text
 * @property string $video_link
 * @property string $image_3
 * @property string $section_five_first_text_up
 * @property string $section_five_first_text_mid
 * @property string $section_five_first_text_bottom
 * @property string $section_five_second_text_up
 * @property string $section_five_second_text_mid
 * @property string $section_five_second_text_bottom
 * @property string $section_five_third_text_up
 * @property string $section_five_third_text_mid
 * @property string $section_five_third_text_bottom
 * @property string $section_five_fourth_text_up
 * @property string $section_five_fourth_text_mid
 * @property string $section_five_fourth_text_bottom
 * @property string $section_five_fifth_text_up
 * @property string $section_five_fifth_text_mid
 * @property string $section_five_fifth_text_bottom
 * @property string $section_five_sixth_text_up
 * @property string $section_five_sixth_text_mid
 * @property string $section_five_sixth_text_bottom
 * @property string $section_six_first_text
 * @property string $section_six_second_text
 * @property string $footer_section_one_header
 * @property string $footer_section_one_first
 * @property string $footer_section_two_header
 * @property string $footer_section_three_header
 * @property string $footer_section_three_first
 * @property string $footer_section_three_second
 * @property string $footer_section_three_third
 * @property string $footer_section_four_header
 * @property string $footer_section_four_first
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $sticky_note_text
 * @property int $is_sticky_active 1->active , 0->closed
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionFourFirst($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionFourHeader($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionOneFirst($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionOneHeader($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionThreeFirst($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionThreeHeader($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionThreeSecond($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionThreeThird($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereFooterSectionTwoHeader($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereImage1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereImage2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereImage3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereImageUpFirstText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereImageUpFourthText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereImageUpSecondText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereImageUpThirdText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereIsStickyActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFifthTextBottom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFifthTextMid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFifthTextUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFirstTextBottom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFirstTextMid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFirstTextUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFourthTextBottom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFourthTextMid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveFourthTextUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveSecondTextBottom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveSecondTextMid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveSecondTextUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveSixthTextBottom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveSixthTextMid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveSixthTextUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveThirdTextBottom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveThirdTextMid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFiveThirdTextUp($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFourFirstText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFourHeadingBottom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFourHeadingUpper($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFourSecondText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionFourThirdText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneFifthDownText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneFifthUpText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneFirstBootomText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneFirstUpText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneFourthDownText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneFourthUpText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneHeader($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneSecondDownText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneSecondUpText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneThirdDownText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionOneThirdUpText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionSixFirstText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionSixSecondText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeHeading($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage1($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage10($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage11($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage12($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage13($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage14($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage15($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage16($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage2($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage3($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage4($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage5($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage6($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage7($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage8($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereSectionThreeImage9($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereStickyNoteText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\IndexPageWysiwyg whereVideoLink($value)
 * @mixin \Eloquent
 */
class IndexPageWysiwyg extends Model
{
    //
}
