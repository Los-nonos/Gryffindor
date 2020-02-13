import container from '../Infraestructure/DI/inversify.config';
import asyncMiddleware from '../API/Http/Middleware/AsyncMiddleware';
import CreateUserAction from '../API/Http/Actions/User/CreateUserAction';
import EditUserAction from '../API/Http/Actions/User/EditUserAction';
import DeleteUserAction from '../API/Http/Actions/User/DeleteUserAction';
import FindByIdUserAction from '../API/Http/Actions/User/FindByIdUserAction';
import FindUserAction from '../API/Http/Actions/User/FindUserAction';
import { Router, Request, Response, NextFunction } from 'express';
import { authMiddleware } from '../API/Http/Middleware/AuthenticationMiddleware';

const router = Router();

router.post(
	'/user',
	(req: Request, res: Response, next: NextFunction) => {
		authMiddleware(req, res, next, ['admin']);
	},
	asyncMiddleware(async (req: Request, res: Response) => {
		const action = container.resolve<CreateUserAction>(CreateUserAction);
		await action.execute(req, res);
	}));

router.put(
	'/user/:id',
	(req: Request, res: Response, next: NextFunction) => {
		authMiddleware(req, res, next, ['admin']);
	},
	asyncMiddleware(async (req: Request, res: Response) => {
		const action = container.resolve<EditUserAction>(EditUserAction);
		await action.execute(req, res);
	}));

router.get(
	'/user',
	(req: Request, res: Response, next: NextFunction) => {
		authMiddleware(req, res, next, ['admin']);
	},
	asyncMiddleware(async (req: Request, res: Response) => {
		const action = container.resolve<FindUserAction>(FindUserAction);
		await action.execute(req, res);
	}));

router.get(
	'/user/:id',
	(req: Request, res: Response, next: NextFunction) => {
		authMiddleware(req, res, next, ['admin']);
	},
	asyncMiddleware(async (req: Request, res: Response) => {
		const action = container.resolve<FindByIdUserAction>(FindByIdUserAction);
		await action.execute(req, res);
	}));

router.delete(
	'/user',
	(req: Request, res: Response, next: NextFunction) => {
		authMiddleware(req, res, next, ['admin']);
	},
	asyncMiddleware(async (req: Request, res: Response) => {
		const action = container.resolve<DeleteUserAction>(DeleteUserAction);
		await action.execute(req, res);
	}));

export default router;
