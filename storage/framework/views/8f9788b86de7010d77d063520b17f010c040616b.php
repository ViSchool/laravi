<?php $__env->startSection('content'); ?>


<div class="container">
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning text-center"><h4 class="mb-0">Für den Lehrerzugang anmelden</h4></div>

                <div class="card-body">
                    <form class="" method="POST" action="/register" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo view('honeypot::honeypotFormFields'); ?>

                        <div class="form-row form-group<?php echo e($errors->has('teacher_name') ? ' invalid' : ''); ?>">
                            <label for="teacher_name" class="col-md-4 col-form-label">Name</label>

                            <div class="col-md-6">
                                <input id="teacher_name" type="text" class="form-control" name="teacher_name" value="<?php echo e(old('teacher_name')); ?>"  autofocus>

                                <?php if($errors->has('teacher_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('teacher_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class=" form-row form-group<?php echo e($errors->has('teacher_surname') ? ' invalid' : ''); ?>">
                            <label for="teacher_surname" class="col-md-4 col-form-label">Nachname</label>

                            <div class="col-md-6">
                                <input id="teacher_surname" type="text" class="form-control" name="teacher_surname" value="<?php echo e(old('teacher_surname')); ?>" required autofocus>

                                <?php if($errors->has('teacher_surname')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('teacher_surname')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row form-group<?php echo e($errors->has('email') ? ' invalid' : ''); ?>">
                            <label for="email" class="col-md-4 col-form-label">
                                E-Mail Adresse 
                                <p class="small">Bitte benutze hier Deine Emailadresse der Schule, da wir Deinen Account verifizieren. Du bekommst im Anschluss an Deine Anmeldung eine Email, in der Du Deine Emailadresse bestätigen kannst.</p>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                       <div class="form-group<?php echo e($errors->has('contract') ? ' invalid' : ''); ?>">
                            <label for="contract" class="col-form-label">Wähle das von Dir gewünschte Angebot:</label>
                            <p class="small">Teste alle Angebote zunächst kostenlos. Kurz vor Ende des Testzeitraums bitten wir Dich, ggf. die entsprechende Zahlung vorzunehmen, damit das von Dir gewählte Paket weiter zur Verfügung steht.</p>
                            <div class="card-deck p-3 m-3">
                                <div class="card mb-3" style="min-width:200px;">
                                    <div class="card-header bg-warning">
                                       <div class="form-check form-check-inline d-flex justify-content-start">
                                            <input class="form-check-input mr-4" type="radio" name="contract" id="kostenlos_radio" value="1">
                                            <label class="form-check-label" for="kostenlos_radio">Kostenlos</label>
                                        </div> 
                                    </div>
                                    <div class="card-body">
                                        <ul class="pl-2 m-2">
                                            <li class="small">5 private Lerneinheiten</li> 
                                            <li class="small">1 Jahr technischer Support</li> 
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center ">
                                        <small><br></small>
                                        <p class="m-0 p-0 font-weight-bold">kostenlos</p>
                                    </div>
                                </div>
                                <div class="card mb-3" style="min-width:200px;">
                                    <div class="card-header bg-warning">
                                       <div class="form-check form-check-inline d-flex justify-content-start">
                                            <input class="form-check-input mr-4" type="radio" name="contract" id="lehrer_radio" value="2">
                                            <label class="form-check-label text-black" for="lehrer_radio">Lehrer</label>
                                        </div> 
                                    </div>
                                    <div class="card-body">
                                        <ul class="pl-2 m-2">
                                            <li class="small">30 private Lerneinheiten</li> 
                                            <li class="small">kostenloser technischer und inhaltlicher Support</li>
                                            <li class="small">6 Monate kostenlos testen</li>    
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <br>
                                        <p class="m-0 p-0 font-weight-bold" >12 Euro/ Jahr</p>
                                    </div>
                                </div>
                                <div class="card mb-3" style="min-width:200px;">
                                    <div class="card-header bg-warning">
                                       <div class="form-check form-check-inline d-flex justify-content-start">
                                            <input class="form-check-input mr-4" type="radio" name="contract" id="schule_radio" value="3">
                                            <label class="form-check-label" for="schule_radio"> Schulaccount</label>
                                        </div> 
                                    </div>
                                    <div class="card-body">
                                        <small>Bitte wähle unten Deine Schule aus.</small>
                                    </div>
                                    <div class="card-footer text-center">
                                        <p class="m-0 p-0 font-weight-bold">kostenlos für Lehrer der Schule</p>
                                    </div>
                                </div>
                            </div>
                            <?php if($errors->has('contract')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('contract')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="form-row mt-4 form-group<?php echo e($errors->has('school_id') ? ' invalid' : ''); ?>">
                            <label for="school_id" class="col-md-4 col-form-label">ViSchool-Schulaccount</label>
                            <div class="col-md-6">
                                <select class="form-control" name="school_id" id="school_id">
                                    <option value="">Bitte auswählen</option>
                                    <?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($school->id); ?>"><?php echo e($school->school_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>

                                <?php if($errors->has('school_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('school_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class=" form-row form-group<?php echo e($errors->has('password') ? ' invalid' : ''); ?>">
                            <label for="password" class="col-md-4 col-form-label">Passwort</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="password-confirm" class="col-md-4 col-form-label">Passwort bestätigen</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group m-5">
                                <strong>
                                    Einverständniserklärung zur Erhebung personenbezogener Daten
                                </strong>
                                <p>
                                    Ich bin damit einverstanden, dass die ViSchool GbR ("ViSchool") anhand der von mir eingegeben Daten (wie z.B. meinen Namen und meine E-Mail Adresse) und sonstigen Daten, die bei ViSchool über mich gemäß der <a href="/datenschutz">Datenschutzerklärung</a>  gespeichert sind, ein Profil mit meinen Daten und den von mir erstellten Inhalten speichert und pflegt. Ich kann mein Profil jederzeit in meinem Leherkonto editieren. Wenn ich mein Lehrerkonto lösche, löscht ViSchool auch das über mich erstellte Profil. Sofern ich auch den Newsletter bestelle, wird meine Emailadresse auch für den Versand des Newsletters an diese Emailadresse verwendet. Die Daten werden nicht an Dritte weitergegeben. 
                                    
                                    Ich bin mir bewusst, dass ich diese Einwilligungserklärung jederzeit mit Wirkung für die Zukunft widerrufen kann. Dazu wende ich mich an ViSchool, z.B. über: info@vischool.de.
                                </p>
                            </div>
                        
                        <div class="form-group<?php echo e($errors->has('data_privacy') ? ' invalid' : ''); ?>">
                            <div class="col-md-10 ml-5">
                                <input class="form-check-input mt-2" type="checkbox" aria-label="Checkbox for Data Privacy" id="data_privacy" name="data_privacy" required>
                                <label for="data_privacy" class="form-check-label ml-5">Ich willige in die Erhebung meiner personenbezogenen Daten ein.</label>
                                <?php if($errors->has('data_privacy')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('data_privacy')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('newsletter') ? ' invalid' : ''); ?>">
                            <div class="col-md-10 ml-5">
                                <input class="form-check-input mt-2" type="checkbox" aria-label="Checkbox for Newsletter" id="newsletter" name="newsletter" value="1">
                                <label for="newsletter" class="form-check-label ml-5">ViSchool-Newsletter abonnieren?</label>
                                <?php if($errors->has('newsletter')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('newsletter')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    Als Lehrer registrieren
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/auth/register.blade.php ENDPATH**/ ?>