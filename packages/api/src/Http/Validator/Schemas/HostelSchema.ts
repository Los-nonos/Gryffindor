import * as Joi from '@hapi/joi';
export const CreateHostelSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
  email: Joi.string()
    .email()
    .max(255)
    .required(),
  address: Joi.string()
    .min(3)
    .max(255)
    .required(),
  cuit: Joi.number()
    .min(100000000)
    .max(9999999999)
    .required(),
  password: Joi.string()
    .min(8)
    .max(30)
    .required(),
  tinyDescription: Joi.string()
    .min(15)
    .max(100)
    .allow(''),
});
export const EditHostelSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
  email: Joi.string()
    .email()
    .max(255)
    .required(),
  address: Joi.string()
    .min(3)
    .max(255)
    .required(),
  cuit: Joi.number()
    .min(100000000)
    .max(9999999999)
    .required(),
  password: Joi.string()
    .min(8)
    .max(30)
    .required(),
  tinyDescription: Joi.string()
    .min(15)
    .max(100)
    .allow(''),
});
export const FindByIdHostelSchema = Joi.object().keys({
  id: Joi.number()
    .min(0)
    .required(),
});
export const FindHostelSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
  email: Joi.string()
    .email()
    .max(255)
    .required(),
  address: Joi.string()
    .min(3)
    .max(255)
    .required(),
  cuit: Joi.number()
    .min(100000000)
    .max(9999999999)
    .required(),
  password: Joi.string()
    .min(8)
    .max(30)
    .required(),
  tinyDescription: Joi.string()
    .min(15)
    .max(100)
    .allow(''),
});
export const DeleteHostelSchema = Joi.object().keys({
  id: Joi.number()
    .min(0)
    .required(),
});
