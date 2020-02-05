"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const BaseError_1 = require("../../API/Http/Errors/BaseError");
class InfraestructureError extends BaseError_1.BaseError {
    constructor(message, statusCode) {
        super(message);
        this.statusCode = statusCode;
    }
    getStatusCode() {
        return this.statusCode;
    }
}
exports.InfraestructureError = InfraestructureError;
//# sourceMappingURL=InfraestructureError.js.map