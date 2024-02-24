<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php
  use memberpress\courses\models as models;

  $viewing_attempt = $attempt instanceof models\Attempt && $attempt->is_complete();
  $has_answer = $answer instanceof models\Answer;
  $has_correct_answer = $has_answer && $question->is_answer_correct($answer->answer);
  $classes = ['mpcs-quiz-question', 'mpcs-quiz-question-multiple-choice'];

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
    <div class="mpcs-quiz-question-options">
      <?php if(isset($question->options) && is_array($question->options)) : ?>
        <?php
          $options = apply_filters('mpcs_question_options', $question->options, $question);

          foreach($options as $index => $option) :
            $option_classes = ['mpcs-quiz-question-option'];
            $option_is_correct = false;
            $option_is_incorrect = false;

            if($viewing_attempt && $show_results && $has_answer && $answer->answer == $option) {
              if($question->is_option_correct($option)) {
                $option_is_correct = true;
                $option_classes[] = 'mpcs-quiz-question-option-correct';
              }
              else {
                $option_is_incorrect = true;
                $option_classes[] = 'mpcs-quiz-question-option-incorrect';
              }
            }
          ?>
          <div class="<?php echo esc_attr(join(' ', $option_classes)); ?>">
            <input type="radio" id="mpcs-quiz-question-field-<?php echo esc_attr($question->id); ?>-<?php echo esc_attr($index + 1); ?>" class="mpcs-quiz-question-field mpcs-quiz-question-field-multiple-choice" data-question-id="<?php echo esc_attr($question->id); ?>" name="mpcs_quiz_question_<?php echo esc_attr($question->id); ?>" value="<?php echo esc_attr($option); ?>"<?php echo $has_answer ? checked($answer->answer, $option, false) : ''; ?><?php echo $viewing_attempt ? ' disabled' : ''; ?>>
            <label for="mpcs-quiz-question-field-<?php echo esc_attr($question->id); ?>-<?php echo esc_attr($index + 1); ?>">
              <i class="mpcs-radio-checked"></i>
              <i class="mpcs-radio-unchecked"></i>
            </label>
            <label for="mpcs-quiz-question-field-<?php echo esc_attr($question->id); ?>-<?php echo esc_attr($index + 1); ?>" class="mpcs-quiz-question-option-label"><?php echo esc_html($option); ?></label>
            <?php if($option_is_correct) : ?>
              <span class="mpcs-quiz-correct-answer"><i class="mpcs-correct-answer"></i></span>
            <?php elseif($option_is_incorrect) : ?>
              <span class="mpcs-quiz-incorrect-answer"><i class="mpcs-incorrect-answer"></i></span>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
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
          <div class="mpcs-quiz-question-options">
            <?php foreach($question->options as $index => $option) : ?>
              <?php if($question->is_option_correct($option)) : ?>
                <div class="mpcs-quiz-question-option">
                  <input type="radio" class="mpcs-quiz-question-field mpcs-quiz-question-field-multiple-choice" checked disabled>
                  <label>
                    <i class="mpcs-radio-checked"></i>
                  </label>
                  <label class="mpcs-quiz-question-option-label"><?php echo esc_html($option); ?></label>
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
