"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const tslib_1 = require("tslib");
const inversify_1 = require("inversify");
const InfraestructureError_1 = require("../Errors/InfraestructureError");
const AppError_1 = require("..//Errors/AppError");
let ErrorHandler = class ErrorHandler {
    handle(error, res) {
        if (error instanceof InfraestructureError_1.InfraestructureError) {
            res.status(error.getStatusCode()).send(error.message);
        }
        else if (error instanceof AppError_1.ApplicationError) {
            res.status(500).send('Internal server error');
        }
    }
};
ErrorHandler = tslib_1.__decorate([
    inversify_1.injectable()
], ErrorHandler);
exports.default = ErrorHandler;
//# sourceMappingURL=ErrorHandler.js.map