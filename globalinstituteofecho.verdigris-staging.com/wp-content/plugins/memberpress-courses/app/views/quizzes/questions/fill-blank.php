<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php
  use memberpress\courses\models as models;
  use memberpress\courses\helpers as helpers;

  $viewing_attempt = $attempt instanceof models\Attempt && $attempt->is_complete();
  $has_answer = $answer instanceof models\Answer;
  $data = helpers\Questions::get_fill_blank_data($question, $attempt);
  $has_correct_answer = $has_answer && $question->is_answer_correct($answer->answer);
  $classes = ['mpcs-quiz-question', 'mpcs-quiz-question-fill-blank'];

  if($viewing_attempt && $show_results) {
    $classes[] = $has_correct_answer ? 'mpcs-quiz-question-correct' : 'mpcs-quiz-question-incorrect';
  }
?>
<div id="mpcs-quiz-question-<?php echo esc_attr($question->id); ?>" class="<?php echo esc_attr(join(' ', $classes)); ?>">
  <div class="mpcs-quiz-question-label">
    <label>
      <?php if($viewing_attempt && $show_results) : ?>
        <?php if($has_correct_answer) : ?>
          <span class="mpcs-quiz-correct-answer"><i class="mpcs-correct-answer"></i></span>
        <?php else : ?>
          <span class="mpcs-quiz-incorrect-answer"><i class="mpcs-incorrect-answer"></i></span>
        <?php endif; ?>
      <?php endif; ?>
      <?php echo nl2br(esc_html(apply_filters('mpcs_question_label', $question->text, $question))); ?>
      <?php if(apply_filters('mpcs_question_required_indicator', true, $question) && $question->required) : ?>
        <span class="mpcs-quiz-question-required">*</span>
      <?php endif; ?>
    </label>
  </div>
  <div class="mpcs-quiz-question-input">
    <?php echo do_shortcode(shortcode_unautop(wpautop($data['output']))); ?>
  </div>
  <?php if($viewing_attempt && $show_results && $show_answers && !$has_correct_answer) : ?>
    <?php if($question->feedback) : ?>
      <div class="mpcs-quiz-question-feedback">
        <?php echo $question->get_feedback_html(); ?>
      </div>
    <?php endif; ?>
    <?php if(is_array($data['answers']) && count($data['answers'])) : ?>
      <div class="mpcs-quiz-question-correct-answer-box">
        <div class="mpcs-quiz-question-correct-answer-box-title">
          <?php if(count($data['answers']) > 1) : ?>
            <?php esc_html_e('Correct answers', 'memberpress-courses'); ?>
          <?php else : ?>
            <?php esc_html_e('Correct answer', 'memberpress-courses'); ?>
          <?php endif; ?>
        </div>
        <div class="mpcs-quiz-question-correct-answer-box-answers">
          <?php if(count($data['answers']) > 1) : ?>
            <ol>
              <?php foreach($data['answers'] as $correct_answers) : ?>
                <li><?php echo helpers\Questions::get_fill_blank_correct_answer($correct_answers); ?></li>
              <?php endforeach; ?>
            </ol>
          <?php else : ?>
            <?php echo helpers\Questions::get_fill_blank_correct_answer($data['answers'][0]); ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>
