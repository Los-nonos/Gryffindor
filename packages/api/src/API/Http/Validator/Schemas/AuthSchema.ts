import * as Joi from '@hapi/joi';

export const LoginSchema = Joi.object().keys({
  username: Joi.string()
    .min(3)
    .max(100)
    .required(),
  password: Joi.string()
    .min(3)
    .max(20)
    .required(),
});

export const ChangePasswordSchema = Joi.object().keys({
  id: Joi.number()
    .integer()
    .min(0)
    .required(),
  oldPassword: Joi.string()
    .min(3)
    .max(20)
    .required(),
  newPassword: Joi.string()
    .min(3)
    .max(20)
    .required(),
  confirmNewPassword: Joi.string()
    .min(3)
    .max(20)
    .required(),
});
