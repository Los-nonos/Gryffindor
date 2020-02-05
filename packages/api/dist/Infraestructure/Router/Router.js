"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const tslib_1 = require("tslib");
const bodyParser = require("body-parser");
const inversify_1 = require("inversify");
const index_routes_1 = tslib_1.__importDefault(require("../../routes/index.routes"));
const inversify_config_1 = tslib_1.__importDefault(require("../inversify.config"));
const ErrorHandler_1 = tslib_1.__importDefault(require("../../Infraestructure/utils/ErrorHandler"));
let Router = class Router {
    constructor(express) {
        this.express = express;
    }
    up() {
        this.middlewares();
        this.userRoutes();
        this.catchErrors();
    }
    catchErrors() {
        this.express.use((error, _req, res, next) => {
            if (!error) {
                next();
            }
            const errorHandler = inversify_config_1.default.get(ErrorHandler_1.default);
            errorHandler.handle(error, res);
        });
    }
    middlewares() {
        this.express.use(bodyParser.urlencoded({ extended: false }));
        this.express.use(bodyParser.json());
    }
    userRoutes() {
        this.express.use('/apiv1/', index_routes_1.default);
    }
};
Router = tslib_1.__decorate([
    inversify_1.injectable(),
    tslib_1.__metadata("design:paramtypes", [Function])
], Router);
exports.default = Router;
//# sourceMappingURL=Router.js.map