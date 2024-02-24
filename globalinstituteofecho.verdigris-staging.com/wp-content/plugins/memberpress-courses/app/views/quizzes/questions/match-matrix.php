<?php if(!defined('ABSPATH')) { die('You are not allowed to call this page directly.'); } ?>
<?php
  use memberpress\courses\models as models;
  use memberpress\courses\helpers as helpers;

  $viewing_attempt = $attempt instanceof models\Attempt && $attempt->is_complete();
  $has_answer = $answer instanceof models\Answer;
  $has_correct_answer = $has_answer && $question->is_answer_correct($answer->answer);
  $classes = ['mpcs-quiz-question', 'mpcs-quiz-question-match-matrix'];

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
    <?php if(isset($question->options) && is_array($question->options)) : ?>
      <div class="mpcs-quiz-question-matrix-options">
        <div class="mpcs-quiz-question-matrix-list">
          <?php
            $options = apply_filters('mpcs_question_options', $question->options, $question);

            if(count($options)) :
              $scrambled_answers = is_array($question->answer) ? helpers\Questions::shuffle_array_values($question->answer) : [];

              foreach($options as $index => $option) :
                $option_classes = ['mpcs-quiz-question-matrix-item'];
                $option_is_correct = false;
                $option_is_incorrect = false;

                if($viewing_attempt && $show_results && $has_answer) {
                  if($question->is_match_matrix_answer_correct($answer->answer, $index)) {
                    $option_is_correct = true;
                    $option_classes[] = 'mpcs-quiz-question-matrix-item-correct';
                  }
                  else {
                    $option_is_incorrect = true;
                    $option_classes[] = 'mpcs-quiz-question-matrix-item-incorrect';
                  }
                }
              ?>
              <div class="<?php echo esc_attr(join(' ', $option_classes)); ?>">
                <div class="mpcs-quiz-question-match-matrix-option-value">
                  <label for="mpcs-quiz-question-field-<?php echo esc_attr($question->id); ?>-<?php echo esc_attr($index + 1); ?>"><?php echo esc_html($option); ?></label>
                </div>
                <div class="mpcs-quiz-question-match-matrix-option-answer">
                  <select id="mpcs-quiz-question-field-<?php echo esc_attr($question->id); ?>-<?php echo esc_attr($index + 1); ?>" class="mpcs-quiz-question-field mpcs-quiz-question-field-match-matrix" data-question-id="<?php echo esc_attr($question->id); ?>" name="mpcs_quiz_question_<?php echo esc_attr($question->id); ?>[]" <?php echo $viewing_attempt ? ' disabled' : ''; ?>>
                    <option value=""><?php echo esc_html(apply_filters('mpcs_match_matrix_please_select', __('Please Select', 'memberpress-courses'), $question)); ?></option>
                    <?php foreach($scrambled_answers as $a) : ?>
                      <option value="<?php echo esc_attr($a); ?>" <?php echo $has_answer && is_array($answer->answer) && isset($answer->answer[$index]) ? selected($answer->answer[$index], $a, false) : ''; ?>><?php echo esc_html($a); ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?php if($option_is_correct) : ?>
                  <div class="mpcs-quiz-correct-answer"><i class="mpcs-correct-answer"></i></div>
                <?php elseif($option_is_incorrect) : ?>
                  <div class="mpcs-quiz-incorrect-answer"><i class="mpcs-incorrect-answer"></i></div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <i><?php esc_html_e('No values have been configured for this question.', 'memberpress-courses'); ?></i>
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
      <div class="mpcs-quiz-question-correct-answer-box-title"><?php esc_html_e('Correct answers', 'memberpress-courses'); ?></div>
      <div class="mpcs-quiz-question-correct-answer-box-answers">
        <?php if(isset($question->options) && is_array($question->options)) : ?>
          <ul class="mpcs-quiz-matrix-correct-answers">
            <?php foreach($question->options as $index => $option) : ?>
              <li class="mpcs-quiz-matrix-correct-answer">
                <span class="mpcs-quiz-question-match-matrix-option-value"><?php echo esc_html($option); ?></span>
                <?php if(is_array($question->answer) && isset($question->answer[$index])) : ?>
                  &ndash;
                  <span class="mpcs-quiz-question-match-matrix-option-match"><?php echo esc_html($question->answer[$index]); ?></span>
                <?php endif; ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</div>
