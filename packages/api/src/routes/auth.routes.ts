import { Router, Request, Response } from 'express';
import asyncMiddleware from '../API/Http/Middleware/AsyncMiddleware';
import DI from '../Infraestructure/DI/inversify.config';
import LoginAction from '../API/Http/Actions/Auth/LoginAction';
import ChangePasswordAction from '../API/Http/Actions/Auth/ChangePasswordAction';

const router = Router();

router.post(
  '/login',
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = DI.resolve<LoginAction>(LoginAction);
    await action.execute(req, res);
  }),
);

router.post(
  '/change-password',
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = DI.resolve<ChangePasswordAction>(ChangePasswordAction);
    await action.execute(req, res);
  }),
);

// router.post(
//   '/renew-token',
//   asyncMiddleware(async (req: Request, res: Response) => {
//     const action = DI.resolve<RenewTokenAction>(RenewTokenAction);
//   }),
// );

export default router;
