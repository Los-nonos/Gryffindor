import container from '../Infraestructure/DI/inversify.config';
import asyncMiddleware from '../API/Http/Middleware/AsyncMiddleware';
import CreateRoomAction from '../API/Http/Actions/Room/CreateRoomAction';
import EditRoomAction from '../API/Http/Actions/Room/EditRoomAction';
import DeleteRoomAction from '../API/Http/Actions/Room/DeleteRoomAction';
import FindByIdRoomAction from '../API/Http/Actions/Room/FindByIdRoomAction';
import FindRoomAction from '../API/Http/Actions/Room/FindRoomAction';
import { Router, Request, Response, NextFunction } from 'express';
import { authMiddleware } from '../API/Http/Middleware/AuthenticationMiddleware';

const router = Router();

router.post(
  '/room',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<CreateRoomAction>(CreateRoomAction);
    await action.execute(req, res);
  }),
);

router.put(
  '/room/:id',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<EditRoomAction>(EditRoomAction);
    await action.execute(req, res);
  }),
);

router.get(
  '/room',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<FindRoomAction>(FindRoomAction);
    await action.execute(req, res);
  }),
);

router.get(
  '/room/:id',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<FindByIdRoomAction>(FindByIdRoomAction);
    await action.execute(req, res);
  }),
);

router.delete(
  '/room',
  (req: Request, res: Response, next: NextFunction) => {
    authMiddleware(req, res, next, ['admin']);
  },
  asyncMiddleware(async (req: Request, res: Response) => {
    const action = container.resolve<DeleteRoomAction>(DeleteRoomAction);
    await action.execute(req, res);
  }),
);

export default router;
