  $(document).ready(function() {
    $('#contact_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	nombre: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Por favor, introduzca su nombre'
                    }
                }
            },
            apellido: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Por favor, introduzca su apellido'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, introduzca un email valido'
                    },
                    emailAddress: {
                        message: 'Por favor, introduzca un email valido'
                    }
                }
            },
            edificio: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Por favor, introduzca un edificio'
                    }
                }
            },
            sala: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                    	message: 'Por favor, introduzca un edificio'
                    }
                }
            },
            hora_inicio: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, introduzca una hora de inicio valida'
                    }
                }
            },
            hora_fin: {
                validators: {
                    notEmpty: {
                    	message: 'Por favor, introduzca una hora de fin valida'
                    }
                }
            },
            fecha: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, introduzca una fecha'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Por favor, introduzca al menos 10 caracteres y no mas de 200'
                    },
                    notEmpty: {
                        message: 'Por favor, introduzca al menos 10 caracteres y no mas de 200'
                    }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});