"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const BaseError_1 = require("../../API/Http/Errors/BaseError");
class ApplicationError extends BaseError_1.BaseError {
    constructor(message, description) {
        super(message);
        this.description = description;
    }
    getDescription() {
        return this.description;
    }
}
exports.ApplicationError = ApplicationError;
//# sourceMappingURL=AppError.js.map