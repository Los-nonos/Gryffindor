import * as Joi from '@hapi/joi';

export const IdSchema = Joi.object().keys({
  id: Joi.number()
    .min(0)
    .required(),
});
