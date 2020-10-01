<?php $__env->startSection('content'); ?>

<?php
    $subjects= $class->subjects;
?>
<style>
  .nav-tabs > li {
     float: none;
    margin-bottom: -1px;
  }
  html, body{
      width: 100%;
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: sans-serif;
      background-color: #2c3e50;
  }

  .correct{
      color:green;
      font-size: large;
      font-weight: bolder;
  }

  h1, h2, h3, h4, h5, h6{
      font-weight: 200;
  }
  #qst {
      font-size:x-large!important;
      font-weight: bolder!important;
      color:black;
  }
  input{
      margin: 20px auto;
      padding: 8px 10px;
      border: none;
      outline: none;
      color:black;
  }

  button{
      padding: 8px 20px;
      background-color: #2ecc71;
      color: #fff;
      border: none;
      cursor: pointer;
  }

  .addQuestions, h1{
      margin: 40px auto;
      text-align: center;
      color: #fff;
  }

  .info{
      text-align: center;
  }

  .info li{
      list-style-type: none;
      color: #fff;
  }

  .info button{
      margin: 30px 0;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
  }

  .questionsWrapper div{
      display: none;
      position: absolute;
  }

  .questionsWrapper div.is-active{
      display: block;
  }

  .questionDiv{
      margin: 20px auto;
      text-align: center;
      width: 100%;
  }

  .questionDiv li{
      list-style-type: none;
      color: #fff;
      padding: 12px 0;
  }

  .questionDiv li.correct, .questionDiv li.wrong{
      cursor: pointer;
  }

  .answersCorrect{
      color: #fff;
      text-align: center;
  }

  .nextButton{
      margin: 20px auto;
  }

</style>
<style>
  .text-notes {
    height: 50px;
    background: #d6cab8;
    overflow: hidden;
    position: relative;
  }
  .text-notes p {
    position: absolute;
    color: #333;
    width: 100%;
    height: 100%;
    margin: 0;
    line-height: 50px;
    text-align: center;
    /* Starting position */
    -moz-transform:translateX(-100%);
    -webkit-transform:translateX(-100%);
    transform:translateX(-100%);
    /* Apply animation to this element */
    -moz-animation: text-notes 25 linear infinite;
    -webkit-animation: text-notes 25 linear infinite;
    animation: text-notes 25s linear infinite;
  }
  /* Move it (define the animation) */
  @-moz-keyframes text-notes {
    0%   { -moz-transform: translateX(-100%); }
    100% { -moz-transform: translateX(100%); }
  }
  @-webkit-keyframes text-notes {
    0%   { -webkit-transform: translateX(-100%); }
    100% { -webkit-transform: translateX(100%); }
  }
  @keyframes  text-notes {
    0%   {
      -moz-transform: translateX(-100%); /* Firefox bug fix */
      -webkit-transform: translateX(-100%); /* Firefox bug fix */
      transform: translateX(-100%);
    }
    100% {
      -moz-transform: translateX(100%); /* Firefox bug fix */
      -webkit-transform: translateX(100%); /* Firefox bug fix */
      transform: translateX(100%);
    }
  }
</style>
<?php if($notes->count()>0): ?>
  <div class="text-notes">
    <?php $__currentLoopData = $notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <p><?php echo $note->content.' ' ?></p>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
<?php endif; ?>;
<div id="content">
  <?php if(Auth::user()->hasAnyRole([0,1])): ?>
    <div class="header-card table-cards color-grey">
      <div class="row">
        <div class="col-lg-4">
          <div class="content-header">
            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> إدارة <?php echo e($class->name); ?></small></h1>
          </div>
        </div>
        <div class="col-lg-2">

        </div>
        <div class="col-lg-6">
          <a href="<?php echo e(route('class.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > إدارة كافة البرامج
            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
          </a>
        </div>
      </div>
    </div>
  <?php elseif(Auth::user()->hasAnyRole([2,3])): ?>
    <div class="header-card table-cards color-grey">
      <div class="row">
        <div class="col-lg-4">
          <div class="content-header">
            <h1><small><i class="fa fa-cogs" aria-hidden="true" style="font-size:26px;"></i> محتوى <?php echo e($class->name); ?></small></h1>
          </div>
        </div>

        <div class="col-lg-2">
          <form action="<?php echo e(route('classrequest.store')); ?>" method="POST" id="makeClassFreeForm" style="display:inline; margin-right:10px;">
            <?php echo csrf_field(); ?>

            <input type="hidden" name="class_id" value="<?php echo e($class->id); ?>">
            <a href="#" class="btn btn-success button-margin-header custom-but"
               onclick="document.getElementById('makeClassFreeForm').submit();"> طلب انضمام لهذا البرنامج</a>
          </form>
        </div>
        <div class="col-lg-6">
          <a href="<?php echo e(route('class.index')); ?>" class="btn btn-primary button-margin-header custom-but pull-left" > العودة
            <i class="fa fa-angle-double-left" aria-hidden="true" style="font-size: 20px;"></i>
          </a>
        </div>
      </div>
    </div>
  <?php endif; ?>



    <?php if(($class->free && Auth::user()->hasRole(3)) || (!Auth::user()->hasRole(3)) ): ?>

      <div class="container">
        <ul class="nav nav-tabs " style="margin-right: 15em;
    display: flex;
    align-items: center;">
          <li class="active"><a data-toggle="tab" href="#home">المواد الدراسية</a></li>
		  <li><a data-toggle="tab" onclick="pauseAllAudio()" href="#menu4">طلاب البرنامج</a></li>

        </ul>
        </ul>
		<script>
			function pauseAllAudio()
			{
				var sounds = document.getElementsByTagName('audio');
				for(i=0; i<sounds.length; i++) sounds[i].pause();
				var ifrms=document.getElementsByTagName('iframe');
				for(i=0;i<ifrms.length;i++)
				{
					var src=ifrms[i].src;
					ifrms[i].src="";
					ifrms[i].src=src;

				}
			}
		</script>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12  col-m-u">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <div class="col-lg-8 ">
                        <h2>
                          <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> المواد الدراسية ضمن <?php echo e($class->name); ?></small>
                        </h2>
                      </div>
                      <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) || Auth::user()->hasRole(2)): ?>
                        <div claass="col-lg-2">
                          <a href="/subjects/create?selectedclass=<?php echo e($class->id); ?>" class="btn btn-success button-margin-header custom-but" style="margin-right: 22px" >إضافة مادة
                            <i class="fa fa-plus" aria-hidden="true" style="font-size:16px"></i>
                          </a>
                        </div>
                      <?php endif; ?>
                    </div>
                    <table class="table table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th>اسم المادة</th>
                        <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                          <th>التفعيل</th>
                        <?php endif; ?>
                        <th>عدد الوحدات الدرسية</th>
                        <th>قابلية الدروس للتنزيل</th>
                        <th>العرض</th>
                        <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                          <th>التعديل</th>
                          <th>الحذف</th>
                        <?php endif; ?>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $class->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($subject->name); ?></td>
                          <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                            <?php if($subject->active): ?>
                              <td class="operations">
                                <form action="<?php echo e(route('subject.deactivate', $subject)); ?>" method="POST" id="activateForm">
                                  <?php echo csrf_field(); ?>

                                  <button id="<?php echo e($subject->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#<?php echo e($subject->id); ?>').click();" >
                                    <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                  </a>
                                </form>
                              </td>
                            <?php else: ?>
                              <td class="operations">
                                <form action="<?php echo e(route('subject.activate', $subject)); ?>" method="POST" id="activateForm">
                                  <?php echo csrf_field(); ?>

                                  <button id="<?php echo e($subject->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#<?php echo e($subject->id); ?>').click();" >
                                    <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                  </a>
                                </form>
                              </td>
                            <?php endif; ?>
                          <?php endif; ?>
                          <td><?php echo e($subject->units->count()); ?></td>
                          <?php if($subject->downloable): ?>
                            <td>قابلة للتنزيل</td>
                          <?php else: ?>
                            <td>غير قابلة للتنزيل</td>
                          <?php endif; ?>
                          <td>
                            <div class="operations show">
                              <a href="<?php echo e(route('subject.show', $subject)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                            </div>
                          </td>
                          <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                            <td>
                              <div class="operations update">
                                <a href="<?php echo e(route('subject.edit', $subject)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                              </div>
                            </td>
                            <td>
                              <div class="operations delete">
                                <form action="<?php echo e(route('subject.destroy', $subject)); ?>" method="POST" id="deleteForm">
                                  <?php echo csrf_field(); ?>

                                  <input type="hidden" name="_method" value="DELETE">
                                  <button id="del<?php echo e($subject->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:" class="" onclick="$('#del<?php echo e($subject->id); ?>').click();" >
                                    <i class="fa fa-trash" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                  </a>
                                </form>
                              </div>
                            </td>
                          <?php endif; ?>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                      <div>
                          <h3>اختبار  القبول</h3>
                          <div id="test">
                              <div id="questions">

                              </div>
                              <div class="addQuestions">
                                  <input id="questionInput" type="text" placeholder="السؤال">
                                  <input id="correctInput" type="text" placeholder="الجواب الصحيح">
                                  <input id="wrongOneInput" type="text" placeholder="اجابة خاطئة 1">
                                  <input id="wrongTwoInput" type="text" placeholder="اجابة خاطئة 2">
                                  <button onclick="hndl.addQuestion()">اضافة السؤال</button><br>
                                  <button onclick="hndl.save()">حفظ</button>
                              </div>
                              <p class="answersCorrect"></p>
                              <div class="questionsWrapper"></div>
                          </div>
                      </div>
                  </div>
                </div>

              </div>

            </div>


          </div>
          <div id="menu1" class="tab-pane fade">
            <?php if(Auth::user()->hasRole(0) || Auth::user()->hasRole(1) ): ?>
              <div id="table2" class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 ">
                  <div class="card table-cards color-grey">
                    <div class="card-body">
                      <div class="content-header">
                        <h2>
                          <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> إضافة مدرس لهذا البرنامج</small>
                        </h2>
                      </div>

                      <form action="<?php echo e(route('class.addteacher',$class)); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                          <label for="addteacher">اختر مدرس لاضافته الى هذا الصف :</label>
                          <select class="form-control form-control-select mt-3" id="addteacher" name="teacher">
                            <option selected>-- اختر مدّرس --</option>
                            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($teacher->id); ?>"><?php echo e($teacher->username); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </select>
                        </div>
                        <input type="submit" class="btn btn-success button1" value="اضافة المدرس">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <h2>
                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>مدرسوا الصف</small>
                      </h2>
                    </div>
                    <table class="table table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th>اسم المدرس</th>
                        <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                          <th>حذف</th>
                        <?php endif; ?>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $teachersClass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacherClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($teacherClass->username); ?></td>


                          <?php if(Auth::user()->hasAnyRole([0,1])): ?>
                            <td>
                              <div class="operations delete">
                                <form action="<?php echo e(route('class.deleteteacher',['class' => $class->id, 'teacher_id'=>$teacherClass->id])); ?>" method="POST" id="deleteForm">
                                  <?php echo csrf_field(); ?>


                                  <button id="<?php echo e($class->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                  <a herf="javascript:;" class="" onclick="$('#<?php echo e($class->id); ?>').click();" >
                                    <i class="fa fa-trash" style="font-size:18px;color:#dd4b39"></i>
                                  </a>
                                </form>
                              </div>
                            </td>
                          <?php endif; ?>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="menu2" class="tab-pane fade">

            <?php if($class->advices->count()> 0 ): ?>
              <div id="table3" class="row">
                <table class="col-lg-12 col-sm-12 col-md-12 table table-bordered table-hover table-width">
                  <thead>
                  <tr>
                    <th>اسم النصيحة</th>
                    <th>الملف</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php  foreach ($classAdvices as $classAdvice): ?>
                  <tr>
                    <td><?php echo e($classAdvice->title); ?></td>
                    <td>

                      <?php if(  $classAdvice->type == "video"): ?>





                            <?php

                            $src = '' ;
                            if(strpos($classAdvice->src, 'youtu.be')){
                                $src=str_replace("/storage//youtu.be/","",$classAdvice->src);
                            }


                            ?>

                        <iframe  width="320" height="240" src="https://www.youtube.com/embed/<?php echo $src;?>"></iframe>
                      <?php elseif( $classAdvice->type == "audio"): ?>

                        <audio controls>
                          <source src= <?php echo $classAdvice->src; ?> type="audio/ogg">
                          <source src= <?php echo $classAdvice->src; ?> type="audio/mpeg">
                          Your browser does not support the audio element.
                        </audio>

                      <?php endif; ?>
                    </td>


                  </tr>
                  <?php  endforeach;  ?>
                  </tbody>
                </table>
              </div>
            <?php endif; ?>


          </div>
          <div id="menu3" class="tab-pane fade">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <h2>
                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i> الدينيمي</small>
                      </h2>
                    </div>
                    <table class="table table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th>العنوان</th>
                        <th>الفعالية</th>
                        <th>الفصل</th>
                        <th>النوع</th>
                        <th>عرض</th>
                        <th>تعديل</th>
                        <th>حذف</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $__currentLoopData = $denemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deneme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr>
                          <td><?php echo e($deneme->title); ?></td>
                          <?php if($deneme->active): ?>
                            <td class="operations">
                              <form action="<?php echo e(route('deneme.deactivate', $deneme)); ?>" method="POST" id="activateForm">
                                <?php echo csrf_field(); ?>

                                <button id="<?php echo e($deneme->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                <a herf="javascript:;" class="" onclick="$('#<?php echo e($deneme->id); ?>').click();" >
                                  <i class="fa fa-check-circle" aria-hidden="true" style="font-size:18px;color:#5cb85c;cursor: pointer;"></i>
                                </a>
                              </form>
                            </td>
                          <?php elseif(!$deneme->active): ?>
                            <td class="opreations">
                              <form action="<?php echo e(route('deneme.activate', $deneme)); ?>" method="POST" id="activateForm">
                                <?php echo csrf_field(); ?>

                                <button id="<?php echo e($deneme->id); ?>" class=" btn-xs delete-button" style="display:none;"></button>
                                <a herf="javascript:;" class="" onclick="$('#<?php echo e($deneme->id); ?>').click();" >
                                  <i class="fa fa-times-circle" aria-hidden="true" style="font-size:18px;color:#dd4b39;cursor: pointer;"></i>
                                </a>
                              </form>
                            </td>
                          <?php endif; ?>
                          <td><?php echo e($deneme->term); ?></td>
                          <td><?php echo e($deneme->type); ?></td>
                          <td>
                            <div class="operations show">
                              <a href="<?php echo e(route('deneme.show', $deneme)); ?>"><i class="fa fa-eye" style="font-size:18px;color:#5cb85c"></i></a>
                            </div>
                          </td>
                          <td>
                            <div class="operations update">
                              <a href="<?php echo e(route('deneme.edit', $deneme)); ?>"><i class="fa fa-edit" style="font-size:18px;color:#00c0ef"></i></a>
                            </div>
                          </td>
                          <td>
                            <div class="operations delete">
                              <form action="<?php echo e(route('deneme.destroy',['carousel' => $deneme->id])); ?>" method="POST" id="deleteForm">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="_method" value="DELETE">
                                <button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>

                              </form>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


		  <div id="menu4" class="tab-pane fade">
            <div id="table" class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-m-u">
                <div class="card table-cards color-grey">
                  <div class="card-body">
                    <div class="content-header">
                      <h2>
                        <small><i class="fa fa-graduation-cap" aria-hidden="true" style="font-size:24px;"></i>طلاب الصف</small>
                      </h2>
					  <form action="<?php echo e(route('class.deleteAllStudents',['class' => $class->id])); ?>" method="POST" id="deleteForm">
									<?php echo csrf_field(); ?>

									<input type="submit" class="btn btn-danger"  value="فصل جميع الطلاب" />
					   </form>
                    </div>
                    <table class="table table-bordered table-hover table-width">
                      <thead>
                      <tr>
                        <th>اسم الطالب</th>
                        <th>فصل</th>
                      </tr>
                      </thead>
                      <tbody>

                      <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($st->full_name); ?></td>
                          <td>
                            <div class="operations delete">
								<form action="<?php echo e(route('class.deletestudent',['class' => $class->id])); ?>" method="POST" id="deleteForm">
									<?php echo csrf_field(); ?>

									<input type="hidden" name="student_id" value="<?php echo e($st->id); ?>">
									<button class="fa fa-trash"  style="border:none; font-size:18px;color:#dd4b39;cursor: pointer;" > </button>
								</form>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php endif; ?>





</div>
<form id="quizzform" action="/updatequizz/<?php echo e($class->id); ?>" method="post" style="display:none;">
    <?php echo csrf_field(); ?>
    <textarea name="json" id="json"></textarea>
</form>
<script>
    var quiz = {
        //Array for questions
        questions: [],

        //Add questions as objects to array
        addQuestion: function(question, correct, wrongOne, wrongTwo){
            this.questions.push({
                question: question,
                correct: correct,
                wrongOne: wrongOne,
                wrongTwo: wrongTwo
            });
            //upadate number of questions each time you add one
        },
        addToView(question,correct,wrong1,wrong2)
        {
            let container = document.getElementById("questions");
            let html ="<div id='qst'><h5>"+question+"</h5>";
            html+= "<h6 class='correct'>"+correct+"</h6>"
            html+= "<h6>"+wrong1+"</h6>"
            html+= "<h6>"+wrong2+"</h6>"
            html+="</div><hr>";
            container.innerHTML+= html;
        }
    };

    var hndl = {
        //This runs when you click add question button
        addQuestion: function(){
            //Get each of the inputs by id
            var questionInput = document.getElementById("questionInput");
            var correctInput = document.getElementById("correctInput");
            var wrongOneInput = document.getElementById("wrongOneInput");
            var wrongTwoInput = document.getElementById("wrongTwoInput");
            //pass the values of the inputs into the addQuestion method in the quiz object which will add them to question array
            quiz.addQuestion(questionInput.value, correctInput.value, wrongOneInput.value, wrongTwoInput.value);
            quiz.addToView(questionInput.value, correctInput.value, wrongOneInput.value, wrongTwoInput.value);
            //clear the inputs
            questionInput.value = "";
            correctInput.value = "";
            wrongOneInput.value = "";
            wrongTwoInput.value = "";
        },
        save: function() {
            let json = JSON.stringify(quiz.questions);
            document.getElementById("json").innerHTML = json;
            $("#quizzform").submit();
            console.log(json);
        }
    }

    var view = {
        //This runs when you click start quiz
        displayQuestions: function(){
            //Hide the options to add questions and the info
            var hideAdd = document.querySelector(".addQuestions");
            var hideInfo = document.querySelector(".info");
            hideAdd.style.display = "none";
            hideInfo.style.display = "none";
            //Clear the quesitons wrapper
            var questionsWrapper = document.querySelector(".questionsWrapper");
            questionsWrapper.innerHTML = "";

            //for each quesiton in array create elements neede and give classes
            quiz.questions.forEach(function(question, index){
                var questionDiv = document.createElement("div");
                questionDiv.setAttribute("class", "questionDiv");
                var nextButton = document.createElement("button");
                nextButton.setAttribute("class", "nextButton");
                var questionLi = document.createElement("li");
                var correctLi = document.createElement("li");
                correctLi.setAttribute("class", "correct");
                var wrongOneLi = document.createElement("li");
                wrongOneLi.setAttribute("class", "wrong");
                var wrongTwoLi = document.createElement("li");
                wrongTwoLi.setAttribute("class", "wrong");

                //add each question div to the question wrapper
                questionsWrapper.appendChild(questionDiv);

                questionsWrapper.firstChild.classList.add("is-active");

                //add the text to the inputs the values in the questions array
                questionLi.textContent = question.question;
                correctLi.textContent = question.correct;
                wrongOneLi.textContent = question.wrongOne;
                wrongTwoLi.textContent = question.wrongTwo;

                //If its the last question the button should say finish if not it should say next
                if (index === quiz.questions.length - 1){
                    nextButton.textContent = "Finish";
                } else{
                    nextButton.textContent = "Next";
                }

                //Append elements to div
                questionDiv.appendChild(questionLi);

                //put the answers in a random order before apprending them so correct isnt always 1st
                var array = [correctLi, wrongOneLi, wrongTwoLi];
                array.sort(function(a, b){return 0.5 - Math.random()});
                array.forEach(function(item){
                    questionDiv.appendChild(item);
                });

                questionDiv.appendChild(nextButton);

                this.displayAnswersCorrect();
                quiz.movingToNextQuestion();


            }, this);
        },

        displayAnswersCorrect: function(){
            var questionDiv = document.querySelectorAll(".questionDiv");
            var correctAnswers = 0;
            var answersCorrect = document.querySelector(".answersCorrect");
            answersCorrect.textContent = "Correct answers: " + correctAnswers;

            //add click event to each question div if the element clicked has class correct then add 1 to correctAnswers and change the color of element to green.
            //Else change the color of element to red and find the elemtn with correct class and make it green
            for (var i = 0; i < questionDiv.length; i++) {
                questionDiv[i].onclick = function(event) {
                    event = event || window.event;
                    if(event.target.className === "correct"){
                        correctAnswers++;
                        answersCorrect.textContent = "Correct answers: " + correctAnswers;
                        event.target.style.color = "#2ecc71";
                    } else if(event.target.className === "wrong"){
                        event.target.style.color = "#e74c3c";
                        var itemChildren = event.target.parentNode.children;
                        for(i = 0; i < itemChildren.length; i++){
                            if(itemChildren[i].classList.contains("correct")){
                                itemChildren[i].style.color = "#2ecc71";
                            }
                        }
                    }
                    //Remove correct and wrong classes so the same question the score cant go up and colors cant chaneg
                    var itemChildren = event.target.parentNode.children;
                    for(i = 0; i < itemChildren.length; i++){
                        itemChildren[i].classList.remove("correct");
                        itemChildren[i].classList.remove("wrong");
                    }
                }
            }

        },

        //count objects in array to show how many questions added to screen
        displayNumberOfQuestions: function(){

        }
    }
    console.log(hndl);
</script>






<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>
    <script>
        function fetchQuizz() {
            jQuery.ajax({
                url: '/getQuizz/<?php echo e($class->id); ?>',
                method:'get',
                data: {
                    __token: '<?php echo e(csrf_token()); ?>'
                },
                success: function(data) {
                    console.log(data);
                    let js = JSON.parse(data);
                    for(let i = 0;i<js.length;i++)
                    {
                       console.log("Question:"+js[i].question);
                       console.log("1:"+js[i].correct);
                       console.log("2:"+js[i].wrongOne);
                       console.log("3:"+js[i].wrongTwo);
                       quiz.addToView(js[i].question,js[i].correct,js[i].wrongTwo,js[i].wrongOne);
                    }
                }
            });
        }

        fetchQuizz();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\work\hmls\resources\views/admin/classes/show.blade.php ENDPATH**/ ?>
