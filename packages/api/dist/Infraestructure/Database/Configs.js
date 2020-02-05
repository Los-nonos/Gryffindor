"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
const tslib_1 = require("tslib");
const typeorm_1 = require("typeorm");
function createConnectionDB() {
    return tslib_1.__awaiter(this, void 0, void 0, function* () {
        if (process.env.MODE === 'production') {
            yield typeorm_1.createConnection({
                type: 'mysql',
                host: process.env.HOST_DB || 'mysql',
                port: 3307,
                username: process.env.DATABASE_USER || 'root',
                password: process.env.DATABASE_PASSWORD || 'camp123',
                database: process.env.DATABASE_DB || 'coderscamp_db',
                synchronize: true,
                logging: true,
                migrations: ['../../Persistance/Migrations/*.ts'],
                migrationsTableName: 'migrations',
                migrationsRun: false,
                entities: [],
                cli: {
                    migrationsDir: '../../Persistance/Migrations',
                },
            });
        }
        else {
            yield typeorm_1.createConnection({
                type: 'mysql',
                host: process.env.HOST_DB || 'mysql',
                port: 3307,
                username: process.env.DATABASE_USER || 'root',
                password: process.env.DATABASE_PASSWORD || 'camp123',
                database: process.env.DATABASE_DB || 'coderscamp_db',
                synchronize: true,
                logging: true,
                entities: [],
            });
        }
    });
}
exports.createConnectionDB = createConnectionDB;
//# sourceMappingURL=Configs.js.map