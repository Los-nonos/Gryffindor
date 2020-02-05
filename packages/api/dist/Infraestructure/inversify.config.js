"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const tslib_1 = require("tslib");
const inversify_1 = require("inversify");
require("reflect-metadata");
const ErrorHandler_1 = tslib_1.__importDefault(require("../Infraestructure/utils/ErrorHandler"));
const Validator_1 = tslib_1.__importDefault(require("../API/Http/Validator/Validator"));
var container = new inversify_1.Container();
container.bind(ErrorHandler_1.default).toSelf();
container.bind(Validator_1.default).toSelf();
exports.default = container;
//# sourceMappingURL=inversify.config.js.map