import { Router } from 'express';
import room from './room.routes';

const router = Router();

router.use(room);

export default router;
