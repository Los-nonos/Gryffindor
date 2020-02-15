import userRouter from './user.routes';
import authRouter from './auth.routes';
import userRoleRouter from './userrole.routes';
import { Router } from 'express';

const router = Router();

router.use(userRouter);

router.use(authRouter);

router.use(userRoleRouter);

export default router;
