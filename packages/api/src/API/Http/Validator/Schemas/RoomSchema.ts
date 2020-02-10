import * as Joi from '@hapi/joi';
export const CreateRoomSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
});
export const EditRoomSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
});
export const FindByIdRoomSchema = Joi.object().keys({
  id: Joi.number()
    .min(0)
    .required(),
});
export const FindRoomSchema = Joi.object().keys({
  name: Joi.string()
    .min(5)
    .max(100)
    .required(),
});
export const DeleteRoomSchema = Joi.object().keys({
  id: Joi.number()
    .min(0)
    .required(),
});
