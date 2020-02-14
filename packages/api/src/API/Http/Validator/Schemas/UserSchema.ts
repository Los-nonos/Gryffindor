import * as Joi from '@hapi/joi';
export const CreateUserSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
  email: Joi.string()
    .email()
    .max(255)
    .required(),
  phone: Joi.string()
    .min(8)
    .max(20)
    .required(),
  password: Joi.string()
    .min(8)
    .max(30)
    .required(),
});
export const EditUserSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
  email: Joi.string()
    .email()
    .max(255)
    .required(),
  phone: Joi.string()
    .min(8)
    .max(20)
    .required(),
  password: Joi.string()
    .min(8)
    .max(30)
    .required(),
});
export const FindByIdUserSchema = Joi.object().keys({
  id: Joi.number()
    .min(0)
    .required(),
});
export const FindUserSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .allow(null),
  email: Joi.string()
    .email()
    .max(255)
    .allow(null),
  phone: Joi.string()
    .min(8)
    .max(20)
    .allow(null),
  password: Joi.string()
    .min(8)
    .max(30)
    .allow(null),
});
export const DeleteUserSchema = Joi.object().keys({
  id: Joi.number()
    .min(0)
    .required(),
});
