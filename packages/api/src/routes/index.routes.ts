import userRouter from './user.routes';
import authRouter from './auth.routes';
import { Router } from 'express';

const router = Router();

router.use(userRouter);

router.use(authRouter);

export default router;
