<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php
  use memberpress\courses\models as models;
  use memberpress\courses\helpers as helpers;

  $viewing_attempt = $attempt instanceof models\Attempt && $attempt->is_complete();
  $has_answer = $answer instanceof models\Answer;
  $has_correct_answer = $has_answer && $question->is_answer_correct($answer->answer);
  $classes = ['mpcs-quiz-question', 'mpcs-quiz-question-sort-values'];

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
    <p><?php esc_html_e('Drag and Drop the items into the correct order.', 'memberpress-courses'); ?></p>
    <?php if(isset($question->options) && is_array($question->options)) : ?>
      <div class="mpcs-quiz-question-sort-options">
        <div class="<?php echo esc_attr($viewing_attempt ? 'mpcs-quiz-question-sort-list-a' : 'mpcs-quiz-question-sort-list'); ?>">
          <?php
            $options = apply_filters('mpcs_question_options', $question->options, $question);
            $options = helpers\Questions::shuffle_array_values($options);

            if($has_answer && is_array($answer->answer)) {
              $options = $answer->answer;
            }

            if(count($options)) :
              foreach($options as $index => $option) :
                $option_classes = [$viewing_attempt ? 'mpcs-quiz-question-sort-list-item-a' : 'mpcs-quiz-question-sort-list-item'];

                if($viewing_attempt && $show_results && $has_answer) {
                  if($question->is_sort_option_correct($option, $index)) {
                    $option_classes[] = 'mpcs-quiz-question-sort-list-item-correct';
                  }
                  else {
                    $option_classes[] = 'mpcs-quiz-question-sort-list-item-incorrect';
                  }
                }
              ?>
              <div class="<?php echo esc_attr(join(' ', $option_classes)); ?>">
                <input type="hidden" class="mpcs-quiz-question-field mpcs-quiz-question-field-sort-values" data-question-id="<?php echo esc_attr($question->id); ?>" name="<?php echo !$has_answer ? 'unsorted-' : ''; ?>mpcs_quiz_question_<?php echo esc_attr($question->id); ?>[]" value="<?php echo esc_attr($option); ?>">
                <span class="mpcs-quiz-question-sort-option-value"><?php echo esc_html($option); ?></span>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <?php if($has_answer && is_array($answer->answer)) : ?>
              <i><?php esc_html_e('No answer was provided.', 'memberpress-courses'); ?></i>
            <?php else : ?>
              <i><?php esc_html_e('No values have been configured for this question.', 'memberpress-courses'); ?></i>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <?php if($viewing_attempt && $show_results && $show_answers && !$has_correct_answer) : ?>
    <?php if($question->feedback) : ?>
      <div class="mpcs-quiz-question-feedback">
        <?php echo $question->get_feedback_html(); ?>
      </div>
    <?php endif; ?>
    <div class="mpcs-quiz-question-correct-answer-box">
      <div class="mpcs-quiz-question-correct-answer-box-title"><?php esc_html_e('Correct answer', 'memberpress-courses'); ?></div>
      <div class="mpcs-quiz-question-correct-answer-box-answers">
        <?php if(isset($question->options) && is_array($question->options)) : ?>
          <div class="mpcs-quiz-question-sort-options">
            <div class="mpcs-quiz-question-sort-list-a">
              <?php foreach($question->options as $index => $option) : ?>
                <div class="mpcs-quiz-question-sort-list-item-a">
                  <span class="mpcs-quiz-question-sort-option-value"><?php echo esc_html($option); ?></span>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
