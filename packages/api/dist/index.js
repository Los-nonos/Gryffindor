"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const tslib_1 = require("tslib");
const express = require("express");
const Router_1 = tslib_1.__importDefault(require("./Infraestructure/Router/Router"));
require("reflect-metadata");
const dotenv = tslib_1.__importStar(require("dotenv"));
const Configs_1 = require("./Infraestructure/Database/Configs");
class App {
    constructor() {
        dotenv.config();
        this.express = express();
        Configs_1.createConnectionDB();
        this.router = new Router_1.default(this.express);
    }
    run() {
        process
            .on('unhandledRejection', (reason, p) => {
            console.error(reason, 'Unhandled Rejection at Promise', p);
        })
            .on('uncaughtException', err => {
            console.error(err, 'Uncaught Exception thrown');
            process.exit(1);
        });
        const port = parseInt(process.env.API_PORT, 10) || 3001;
        this.upServer(port);
        this.router.up();
    }
    upServer(port) {
        this.express.listen(port, function () {
            console.log(`Server is run in port ${port}`);
        });
    }
}
const app = new App();
app.run();
//# sourceMappingURL=index.js.map