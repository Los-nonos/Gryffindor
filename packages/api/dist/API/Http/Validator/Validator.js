"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const tslib_1 = require("tslib");
const Joi = require("joi");
const inversify_1 = require("inversify");
let Validator = class Validator {
    validator(data, schema) {
        const validationsOptions = { abortEarly: false, allowUnknown: true };
        const { error } = Joi.validate(data, schema, validationsOptions);
        return error;
    }
    validationResult(errors) {
        const usefulErrors = {
            errors: {},
            type: 'UnprocessableEntity',
        };
        errors.map((error) => {
            if (error.type === 'E0001') {
                usefulErrors.type = 'BadRequestException';
            }
            if (!usefulErrors.errors.hasOwnProperty(error.path.join('_'))) {
                usefulErrors.errors[error.path.join('_')] = {
                    field: error.path.join('_'),
                    type: error.type,
                    message: error.message,
                };
            }
        });
        return usefulErrors;
    }
};
Validator = tslib_1.__decorate([
    inversify_1.injectable()
], Validator);
exports.default = Validator;
//# sourceMappingURL=Validator.js.map