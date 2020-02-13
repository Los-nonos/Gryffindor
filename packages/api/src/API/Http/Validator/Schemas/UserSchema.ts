import * as Joi from '@hapi/joi';
export const CreateUserSchema = Joi.object().keys({
name: Joi.string().min(5).max(100).required(),.required(),email: Joi.string().email().max(255).required(),.required(),phone: Joi.string().min(8).max(20).required(),.required(),password: Joi.string().min(8).max(30).required(),.required(),
});
export const EditUserSchema = Joi.object().keys({
name: Joi.string().min(5).max(100).required(),.required(),email: Joi.string().email().max(255).required(),.required(),phone: Joi.string().min(8).max(20).required(),.required(),password: Joi.string().min(8).max(30).required(),.required(),
});
export const FindByIdUserSchema = Joi.object().keys({
id: Joi.number().min(0).required(),
});
export const FindUserSchema = Joi.object().keys({
name: Joi.string().min(5).max(100).required(),.allow(null),email: Joi.string().email().max(255).required(),.allow(null),phone: Joi.string().min(8).max(20).required(),.allow(null),password: Joi.string().min(8).max(30).required(),.allow(null),
});
export const DeleteUserSchema = Joi.object().keys({
id: Joi.number().min(0).required(),
});
